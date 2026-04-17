<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\LinkLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class LinkController extends Controller
{

    /**
     * Xử lý rút gọn link.
     */
    public function shorten(Request $request)
    {
        $blacklist = ['login', 'register', 'logout', 'api', 'stats', 'logs', 'chart', 'admin', 'dashboard', 'settings', 'profile'];

        $rules = [
            'url' => 'required|url',
            'custom_code' => Auth::check() ? [
                'nullable',
                'string',
                'min:6',
                'max:20',
                'regex:/^[a-zA-Z0-9]+$/',
                Rule::unique('links', 'short_code'),
                function ($attribute, $value, $fail) use ($blacklist) {
                    if (in_array(strtolower($value), $blacklist)) {
                        $fail('Mã tùy chỉnh này thuộc hệ thống, vui lòng chọn mã khác.');
                    }
                },
            ] : ['prohibited'],
            'password' => 'nullable|string|min:4',
            'expires_at' => 'nullable|date|after:now',
            'click_limit' => 'nullable|integer|min:1',
            'title' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|url'
        ];

        $messages = [
            'url.required' => 'Vui lòng nhập địa chỉ URL.',
            'url.url' => 'Địa chỉ URL không hợp lệ.',
            'custom_code.min' => 'Mã tùy chỉnh phải có ít nhất 6 ký tự.',
            'custom_code.max' => 'Mã tùy chỉnh không được quá 20 ký tự.',
            'custom_code.prohibited' => 'Vui lòng đăng nhập để sử dụng tính năng mã tùy chỉnh.',
            'custom_code.regex' => 'Mã tùy chỉnh chỉ được chứa chữ cái và số, không có ký tự đặc biệt.',
            'custom_code.unique' => 'Mã tùy chỉnh này đã được sử dụng, vui lòng chọn mã khác.',
            'password.min' => 'Mật khẩu phải có ít nhất 4 ký tự.',
            'expires_at.after' => 'Thời gian hết hạn phải ở tương lai.',
            'thumbnail.url' => 'Link ảnh thumbnail không hợp lệ.'
        ];

        $request->validate($rules, $messages);

        $shortCode = $request->custom_code;

        // Nếu là khách hoặc không nhập custom_code, generate ngẫu nhiên
        if (!$shortCode) {
            do {
                $shortCode = Str::random(6);
            } while (Link::where('short_code', $shortCode)->exists());
        }

        $link = Link::create([
            'user_id' => Auth::id(),
            'original_url' => $request->url,
            'short_code' => $shortCode,
            'password' => $request->password ? \Illuminate\Support\Facades\Crypt::encryptString($request->password) : null,
            'expires_at' => $request->expires_at,
            'click_limit' => $request->click_limit,
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => $request->thumbnail,
            'clicks' => 0
        ]);

        return response()->json([
            'short_url' => url('/' . $link->short_code),
            'short_code' => $link->short_code,
            'original_url' => $link->original_url,
            'qr_code' => 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' . urlencode(url('/' . $link->short_code))
        ]);
    }

    /**
     * Xử lý chuyển hướng và ghi log.
     */
    public function redirect($short_code)
    {
        $link = Link::where('short_code', $short_code)->first();

        if (!$link) {
            return redirect('/')->with('error', "Xin lỗi, liên kết '{$short_code}' không tồn tại hoặc đã bị xóa.");
        }

        // 0. Kiểm tra trạng thái kích hoạt
        if (!$link->is_active) {
            return redirect('/')->with('error', "Liên kết này hiện đang bị tạm khóa.");
        }

        // 1. Kiểm tra thời gian hết hạn
        if ($link->expires_at && $link->expires_at->isPast()) {
            return redirect('/')->with('error', "Liên kết này đã hết hạn vào lúc " . $link->expires_at->format('H:i d/m/Y') . ".");
        }

        // 2. Kiểm tra giới hạn lượt click
        if ($link->click_limit && $link->clicks >= $link->click_limit) {
            return redirect('/')->with('error', "Liên kết này đã đạt giới hạn lượt truy cập tối đa ({$link->click_limit}).");
        }

        // 3. Kiểm tra mật khẩu (Nếu có)
        // Nếu người dùng đã nhập pass đúng trước đó (lưu trong session), thì bỏ qua check
        if ($link->password && !session()->has("auth_link_{$link->id}")) {
            return view('links.password', compact('link'));
        }

        // Tăng click count
        $link->increment('clicks');

        // Ghi log chi tiết
        LinkLog::create([
            'link_id' => $link->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        // Nếu có tùy chỉnh Social Preview, hiển thị trang chờ để Crawler bắt được Meta Tags
        if ($link->title || $link->description || $link->thumbnail) {
            return view('links.redirecting', compact('link'));
        }

        return redirect()->away($link->original_url);
    }

    /**
     * Xác thực mật khẩu link.
     */
    public function verifyPassword(Request $request, $id)
    {
        $link = Link::findOrFail($id);

        try {
            $decrypted = \Illuminate\Support\Facades\Crypt::decryptString($link->password);
            if ($request->password !== $decrypted) {
                return back()->with('error', 'Mật khẩu không chính xác, vui lòng thử lại.');
            }
        } catch (\Exception $e) {
            // Fallback for old bcrypt hashes
            if (!password_verify($request->password, $link->password)) {
                return back()->with('error', 'Mật khẩu không chính xác, vui lòng thử lại.');
            }
        }

        // Lưu vào session để không phải nhập lại trong phiên làm việc này
        session()->put("auth_link_{$link->id}", true);

        return redirect('/' . $link->short_code);
    }

    /**
     * Lấy danh sách link của người dùng hiện tại (kèm thông tin rút gọn).
     */
    public function stats(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([], 401);
        }

        $query = Link::where('user_id', Auth::id());

        // Lọc theo từ khóa tìm kiếm nếu có
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('original_url', 'like', "%{$search}%")
                    ->orWhere('short_code', 'like', "%{$search}%");
            });
        }

        $links = $query->orderBy('created_at', 'desc')
            ->limit(4)
            ->get()
            ->map(function ($link) {
                return [
                    'id' => $link->id,
                    'original_url' => $link->original_url,
                    'short_code' => $link->short_code,
                    'clicks' => $link->clicks,
                    'created_at' => $link->created_at->diffForHumans(),
                    'full_short_url' => url('/' . $link->short_code)
                ];
            });

        return response()->json($links);
    }

    /**
     * Lấy nhật ký truy cập mới nhất của người dùng.
     */
    public function logs()
    {
        if (!Auth::check()) {
            return response()->json([], 401);
        }

        $logs = LinkLog::whereIn('link_id', function ($query) {
            $query->select('id')->from('links')->where('user_id', Auth::id());
        })
            ->with('link')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($log) {
                $device = $this->getDeviceInfo($log->user_agent);
                return [
                    'id' => $log->id,
                    'link_id' => $log->link_id,
                    'short_code' => $log->link->short_code,
                    'original_url' => $log->link->original_url,
                    'ip' => $log->ip_address,
                    'os' => $device['os'],
                    'browser' => $device['browser'],
                    'created_at' => $log->created_at->diffForHumans()
                ];
            });

        return response()->json($logs);
    }

    /**
     * Phân tích User Agent cơ bản.
     */
    private function getDeviceInfo($ua)
    {
        $os = 'Unknown OS';
        $browser = 'Unknown Browser';

        // OS Detection
        if (preg_match('/windows|win32/i', $ua)) $os = 'Windows';
        elseif (preg_match('/macintosh|mac os x/i', $ua)) $os = 'MacOS';
        elseif (preg_match('/linux/i', $ua)) $os = 'Linux';
        elseif (preg_match('/android/i', $ua)) $os = 'Android';
        elseif (preg_match('/iphone|ipad|ipod/i', $ua)) $os = 'iOS';

        // Browser Detection
        if (preg_match('/chrome/i', $ua) && !preg_match('/edge|edg/i', $ua)) $browser = 'Chrome';
        elseif (preg_match('/firefox/i', $ua)) $browser = 'Firefox';
        elseif (preg_match('/safari/i', $ua) && !preg_match('/chrome/i', $ua)) $browser = 'Safari';
        elseif (preg_match('/edge|edg/i', $ua)) $browser = 'Edge';
        elseif (preg_match('/opera|opr/i', $ua)) $browser = 'Opera';

        return ['os' => $os, 'browser' => $browser];
    }

    /**
     * Dữ liệu biểu đồ click 14 ngày gần nhất + tổng hợp thống kê.
     */
    public function chart()
    {
        if (!Auth::check()) {
            return response()->json([], 401);
        }

        $userId = Auth::id();
        $linkIds = Link::where('user_id', $userId)->pluck('id');

        // Tổng số link
        $totalLinks = $linkIds->count();

        // Link tạo hôm nay
        $todayLinks = Link::where('user_id', $userId)
            ->whereDate('created_at', today())
            ->count();

        // Tổng click
        $totalClicks = Link::where('user_id', $userId)->sum('clicks');

        // Click hôm nay (từ logs)
        $todayClicks = LinkLog::whereIn('link_id', $linkIds)
            ->whereDate('created_at', today())
            ->count();

        // Click theo ngày (14 ngày gần nhất)
        $dailyClicks = [];
        for ($i = 13; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $count = LinkLog::whereIn('link_id', $linkIds)
                ->whereDate('created_at', $date)
                ->count();
            $dailyClicks[] = [
                'date'  => $date,
                'count' => $count,
            ];
        }

        return response()->json([
            'total_links'  => $totalLinks,
            'today_links'  => $todayLinks,
            'total_clicks' => $totalClicks,
            'today_clicks' => $todayClicks,
            'daily_clicks' => $dailyClicks,
        ]);
    }

    /**
     * Xóa link.
     */
    public function delete($id)
    {
        try {
            $link = Link::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            // Xóa logs trước để tránh lỗi khóa ngoại (nếu onDelete cascade chưa thiết lập)
            $link->logs()->delete();
            $link->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Danh sách tất cả liên kết (View).
     */
    public function index(Request $request)
    {
        $query = Link::where('user_id', Auth::id());

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('original_url', 'like', "%{$search}%")
                    ->orWhere('short_code', 'like', "%{$search}%");
            });
        }

        $links = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('links.index', compact('links'));
    }

    /**
     * Chi tiết thống kê một liên kết (View).
     */
    public function show($id)
    {
        $link = Link::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Thống kê click theo ngày (14 ngày gần nhất)
        $dailyClicks = [];
        for ($i = 13; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $count = LinkLog::where('link_id', $link->id)
                ->whereDate('created_at', $date)
                ->count();
            $dailyClicks[] = ['date' => $date, 'count' => $count];
        }

        // Lấy toàn bộ logs cho phân tích
        $allLogs = LinkLog::where('link_id', $link->id)->get();

        // Clicks hôm nay
        $clicksToday = $allLogs->filter(fn($l) => $l->created_at->isToday())->count();

        // Unique visitors (IP duy nhất)
        $uniqueVisitors = $allLogs->pluck('ip_address')->unique()->count();

        // OS & Browser distribution
        $osDist = [];
        $browserDist = [];
        foreach ($allLogs as $log) {
            $device = $this->getDeviceInfo($log->user_agent);
            $osDist[$device['os']] = ($osDist[$device['os']] ?? 0) + 1;
            $browserDist[$device['browser']] = ($browserDist[$device['browser']] ?? 0) + 1;
        }
        arsort($osDist);
        arsort($browserDist);

        // Logs gần nhất (hiển thị)
        $logs = LinkLog::where('link_id', $link->id)
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get()
            ->map(function ($log) {
                $device = $this->getDeviceInfo($log->user_agent);
                return [
                    'ip' => $log->ip_address,
                    'os' => $device['os'],
                    'browser' => $device['browser'],
                    'created_at' => $log->created_at->diffForHumans()
                ];
            });

        return view('links.show', compact('link', 'logs', 'dailyClicks', 'osDist', 'browserDist', 'clicksToday', 'uniqueVisitors'));
    }

    /**
     * API: Chi tiết thống kê của một liên kết (JSON).
     */
    public function detail($id)
    {
        $link = Link::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $allLogs = LinkLog::where('link_id', $link->id)->get();
        $clicksToday = $allLogs->filter(fn($l) => $l->created_at->isToday())->count();
        $uniqueVisitors = $allLogs->pluck('ip_address')->unique()->count();

        $dailyClicks = [];
        for ($i = 13; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $count = LinkLog::where('link_id', $link->id)->whereDate('created_at', $date)->count();
            $dailyClicks[] = ['date' => $date, 'count' => $count];
        }

        return response()->json([
            'link' => $link,
            'metrics' => [
                'total_clicks' => $link->clicks,
                'today_clicks' => $clicksToday,
                'unique_visitors' => $uniqueVisitors
            ],
            'chart' => $dailyClicks
        ]);
    }

    /**
     * API: Cập nhật URL gốc.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'url' => 'sometimes|required|url',
            'password' => 'nullable|string|min:4',
            'remove_password' => 'nullable|boolean',
            'expires_at' => 'nullable|date',
            'click_limit' => 'nullable|integer|min:1',
            'title' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|url'
        ];
        $request->validate($rules);

        $link = Link::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $data = $request->only(['url', 'expires_at', 'click_limit', 'title', 'description', 'thumbnail']);
        if (isset($data['url'])) {
            $data['original_url'] = $data['url'];
            unset($data['url']);
        }

        if ($request->remove_password) {
            $data['password'] = null;
        } elseif ($request->filled('password')) {
            $data['password'] = \Illuminate\Support\Facades\Crypt::encryptString($request->password);
        }

        $link->update($data);
        return response()->json(['success' => true, 'link' => $link]);
    }

    /**
     * API: Reset thống kê.
     */
    public function reset($id)
    {
        $link = Link::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $link->logs()->delete();
        $link->update(['clicks' => 0]);
        return response()->json(['success' => true]);
    }

    /**
     * API: Bật/Tắt trạng thái liên kết.
     */
    public function toggleStatus($id)
    {
        $link = Link::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $link->update(['is_active' => !$link->is_active]);
        return response()->json(['success' => true, 'is_active' => $link->is_active]);
    }
}
