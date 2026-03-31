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
        $rules = [
            'url' => 'required|url',
            'custom_code' => ['nullable', 'string', 'min:6', 'regex:/^[a-zA-Z0-9]+$/', Rule::unique('links', 'short_code')]
        ];

        $request->validate($rules);

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
            'clicks' => 0
        ]);

        return response()->json([
            'short_url' => url('/' . $link->short_code),
            'short_code' => $link->short_code,
            'original_url' => $link->original_url
        ]);
    }

    /**
     * Xử lý chuyển hướng và ghi log.
     */
    public function redirect($short_code)
    {
        $link = Link::where('short_code', $short_code)->firstOrFail();

        // Tăng click count
        $link->increment('clicks');

        // Ghi log chi tiết
        LinkLog::create([
            'link_id' => $link->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        return redirect()->away($link->original_url);
    }

    /**
     * Lấy danh sách link của người dùng hiện tại (kèm thông tin rút gọn).
     */
    public function stats()
    {
        if (!Auth::check()) {
            return response()->json([], 401);
        }

        $links = Link::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
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
                    ->limit(15)
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
}

