<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Kiểm tra user theo google_id
            $user = User::where('google_id', $googleUser->id)->first();

            if (!$user) {
                // Nếu không có google_id, tìm qua email
                $user = User::where('email', $googleUser->email)->first();

                if ($user) {
                    // Nếu user đã tồn tại bằng email, gộp (link) tài khoản
                    $user->update([
                        'google_id' => $googleUser->id,
                    ]);
                } else {
                    // Tạo tài khoản mới
                    $user = User::create([
                        'name' => $googleUser->name ?? 'Người dùng Google',
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'password' => Hash::make(Str::random(24)), // Mật khẩu ngẫu nhiên
                    ]);

                    $user->createPersonalWorkspace();
                }
            }

            Auth::login($user);
            session()->flash('success', 'Đăng nhập bằng Google thành công!');

            return redirect()->intended('/');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Lỗi đăng nhập từ Google. Vui lòng thử lại.');
        }
    }
}
