<?php

namespace App\Http\Controllers;

use App\Models\BioPage;
use App\Models\BioLink;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BioController extends Controller
{
    /**
     * Hiển thị danh sách Bio Pages của người dùng.
     */
    public function index()
    {
        // Lấy workspace cá nhân mặc định (hoặc workspace hiện tại)
        $workspace = Auth::user()->workspaces()->first();
        
        if (!$workspace) {
            Auth::user()->createPersonalWorkspace();
            $workspace = Auth::user()->workspaces()->first();
        }

        $bioPages = $workspace->bioPages()->withCount('links')->latest()->get();

        return view('bio.index', compact('bioPages'));
    }

    /**
     * Trang tạo Bio Page mới (view).
     */
    public function create()
    {
        return view('bio.create');
    }

    /**
     * Xử lý lưu Bio Page mới.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|alpha_dash|max:50|unique:bio_pages,slug',
            'bio' => 'nullable|string|max:1000',
        ]);

        $workspace = Auth::user()->workspaces()->first();

        $bioPage = BioPage::create([
            'workspace_id' => $workspace->id,
            'slug' => $validated['slug'],
            'title' => $validated['title'],
            'bio' => $validated['bio'] ?? '',
            'theme_data' => [
                'background' => '#f8fafc',
                'text_color' => '#1e293b',
                'button_bg' => '#2563eb',
                'button_text' => '#ffffff',
                'button_style' => 'rounded-xl',
            ],
        ]);

        return response()->json([
            'message' => 'Tạo Bio Page thành công!',
            'redirect' => route('bio.edit', $bioPage->id)
        ]);
    }

    /**
     * Trang chỉnh sửa Bio Page (vừa sửa info, vừa sửa link).
     */
    public function edit($id)
    {
        $bioPage = BioPage::with('links')->findOrFail($id);
        
        // Check ownership
        if ($bioPage->workspace->owner_id !== Auth::id()) {
            abort(403);
        }

        return view('bio.edit', compact('bioPage'));
    }

    /**
     * Cập nhật thông tin Bio Page.
     */
    public function update(Request $request, $id)
    {
        $bioPage = BioPage::findOrFail($id);
        
        if ($bioPage->workspace->owner_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'profile_image' => 'nullable|url',
            'theme_data' => 'nullable|array',
        ]);

        $bioPage->update($validated);

        return response()->json(['message' => 'Cập nhật thành công!']);
    }

    /**
     * Public View của Bio Page.
     */
    public function show($slug)
    {
        $bioPage = BioPage::where('slug', $slug)
            ->where('is_active', true)
            ->with(['links' => function($q) {
                $q->where('is_active', true)->orderBy('sort_order', 'asc');
            }])
            ->firstOrFail();

        return view('bio.show', compact('bioPage'));
    }

    /**
     * Thêm link vào Bio Page.
     */
    public function addLink(Request $request, $id)
    {
        $bioPage = BioPage::findOrFail($id);
        
        if ($bioPage->workspace->owner_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'required|url',
            'type' => 'required|string|in:button,social_icon',
            'icon' => 'nullable|string',
        ]);

        $icon = $validated['icon'];
        $label = $validated['label'];

        // Backend detection fallback if icon is empty
        if (empty($icon)) {
            $url = $validated['url'];
            $platforms = [
                'facebook' => ['regex' => '/(facebook\.com|fb\.com|fb\.watch)/i', 'label' => 'Facebook', 'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>'],
                'youtube' => ['regex' => '/(youtube\.com|youtu\.be)/i', 'label' => 'YouTube', 'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.42a2.78 2.78 0 0 0-1.94 2C1 8.11 1 12 1 12s0 3.89.46 5.58a2.78 2.78 0 0 0 1.94 2C5.12 20 12 20 12 20s6.88 0 8.6-.42a2.78 2.78 0 0 0 1.94-2C23 15.89 23 12 23 12s0-3.89-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>'],
                'tiktok' => ['regex' => '/tiktok\.com/i', 'label' => 'TikTok', 'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>'],
                'instagram' => ['regex' => '/instagram\.com/i', 'label' => 'Instagram', 'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>'],
                'twitter' => ['regex' => '/(twitter\.com|x\.com)/i', 'label' => 'X', 'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M4 4l11.733 16H20L8.267 4H4z"/><path d="M4 20l6.768-6.768m2.464-2.464L20 4"/></svg>'],
                'github' => ['regex' => '/github\.com/i', 'label' => 'GitHub', 'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg>'],
                'linkedin' => ['regex' => '/linkedin\.com/i', 'label' => 'LinkedIn', 'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>'],
            ];

            foreach ($platforms as $key => $p) {
                if (preg_match($p['regex'], $url)) {
                    $icon = $p['icon'];
                    break;
                }
            }
        }

        $link = $bioPage->links()->create([
            'label' => $label,
            'url' => $validated['url'],
            'type' => $validated['type'],
            'icon' => $icon,
            'sort_order' => $bioPage->links()->count(),
        ]);

        return response()->json([
            'message' => 'Đã thêm link!',
            'link' => $link
        ]);
    }

    /**
     * Sắp xếp lại thứ tự link.
     */
    public function reorderLinks(Request $request, $id)
    {
        $bioPage = BioPage::findOrFail($id);
        
        if ($bioPage->workspace->owner_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $order = $request->input('order'); // [id1, id2, id3...]
        
        foreach ($order as $index => $linkId) {
            $bioPage->links()->where('id', $linkId)->update(['sort_order' => $index]);
        }

        return response()->json(['message' => 'Đã cập nhật thứ tự!']);
    }

    /**
     * Cập nhật thông tin link.
     */
    public function updateLink(Request $request, $link_id)
    {
        $link = BioLink::findOrFail($link_id);
        $bioPage = $link->bioPage;
        
        if ($bioPage->workspace->owner_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'required|url',
            'type' => 'required|string|in:button,social_icon',
            'icon' => 'nullable|string',
        ]);

        $link->update($validated);

        return response()->json(['message' => 'Cập nhật link thành công!']);
    }

    /**
     * Xóa link.
     */
    public function destroyLink($link_id)
    {
        $link = BioLink::findOrFail($link_id);
        $bioPage = $link->bioPage;
        
        if ($bioPage->workspace->owner_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $link->delete();

        return response()->json(['message' => 'Đã xóa link!']);
    }

    /**
     * Xóa Bio Page.
     */
    public function destroy($id)
    {
        $bioPage = BioPage::findOrFail($id);
        
        if ($bioPage->workspace->owner_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $bioPage->delete();

        return response()->json(['message' => 'Đã xóa Bio Page thành công!']);
    }
}
