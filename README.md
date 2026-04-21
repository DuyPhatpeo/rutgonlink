<p align="center">
  <img src="public/logo.png" width="120" height="120" alt="LinkSnap Logo">
</p>

# 🚀 LinkSnap - URL Shortener & Bio Page Builder

**LinkSnap** là một nền tảng quản lý liên kết toàn diện, kết hợp giữa công cụ rút gọn URL mạnh mẽ và trình xây dựng trang Bio (Link-in-Bio) hiện đại. Được thiết kế với giao diện **Premium UI**, tối ưu hóa trải nghiệm người dùng và cung cấp các hệ thống thống kê chuyên sâu.

[![Laravel Version](https://img.shields.io/badge/Laravel-13.x-red.svg)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.3-blue.svg)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC.svg)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

---

## ✨ Tính năng nổi bật

### 🔗 1. Hệ thống Rút gọn Link Thông minh
*   **Rút gọn tức thì**: Tạo liên kết ngắn gọn chỉ trong 1 giây.
*   **Custom Slugs**: Tùy chỉnh đường dẫn theo thương hiệu cá nhân.
*   **Bảo mật nâng cao**: Hỗ trợ đặt mật khẩu (Password Protected) và ngày hết hạn cho liên kết.
*   **Giới hạn lượt click**: Tự động khóa link sau khi đạt số lượt truy cập nhất định.
*   **Mã QR**: Tự động tạo mã QR đẹp mắt cho từng liên kết, hỗ trợ tải về.

### 📱 2. Trình xây dựng Bio Page (Link-in-Bio)
*   **Live Preview**: Chỉnh sửa và xem thay đổi trực tiếp ngay trên màn hình.
*   **Editor Tabbed**: Giao diện quản lý phân chia rõ ràng (Giao diện, Liên kết, Cài đặt).
*   **Avatar & Social Icons**: Tùy chỉnh ảnh đại diện, phát hiện icon mạng xã hội tự động qua AI.
*   **Thứ tự linh hoạt**: Thay đổi thứ tự các link trên Bio Page bằng cách kéo thả.
*   **Responsive**: Tối ưu hoàn hảo cho các thiết bị di động với Bottom Tab Bar tiện lợi.

### 📊 3. Phân tích & Thống kê Real-time
*   **Interactive Charts**: Biểu đồ tương tác (Chart.js) theo dõi lượt click hàng ngày.
*   **User Insights**: Thống kê chi tiết trình duyệt, hệ điều hành và thiết bị của người dùng.
*   **Click Logs**: Nhật ký truy cập chi tiết kèm địa chỉ IP và thời gian thực.
*   **Unique Visitors**: Phân biệt giữa tổng lượt click và lượt người dùng thực tế.

### 🛡️ 4. Xác thực & Bảo mật
*   **Google OAuth**: Đăng nhập nhanh chóng và an toàn qua Google Socialite.
*   **Session Security**: Bảo mật phiên làm việc với CSRF Protection.

---

## 🛠 Công nghệ sử dụng

*   **Core**: Laravel 13 & PHP 8.3
*   **Frontend**: Tailwind CSS (Glassmorphism UI), Vanilla JavaScript
*   **Database**: MySQL
*   **Charts**: Chart.js
*   **Icons**: Lucide Icons / Heroicons (SVG)
*   **Auth**: Laravel Fortify / Socialite

---

## 🚀 Hướng dẫn cài đặt

### Yêu cầu hệ thống
*   PHP >= 8.3
*   Composer
*   Node.js & NPM
*   MySQL

### Các bước cài đặt

1. **Clone repository:**
   ```bash
   git clone https://github.com/DuyPhatpeo/rutgonlink.git
   cd rutgonlink
   ```

2. **Cài đặt Dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Cấu hình môi trường:**
   - Sao chép file mẫu: `cp .env.example .env`
   - Cập nhật thông tin **DB_DATABASE**, **DB_USERNAME**, **DB_PASSWORD** trong `.env`.
   - Cấu hình Google Client ID/Secret (nếu dùng Google Login).

4. **Khởi tạo ứng dụng:**
   ```bash
   php artisan key:generate
   php artisan migrate
   ```

5. **Chạy ứng dụng:**
   - Mở 2 terminal chạy song song:
   ```bash
   php artisan serve
   npm run dev
   ```

---

## 🎨 Giao diện & Trải nghiệm
Dự án được xây dựng với triết lý thiết kế **Modern & Clean**:
- **Glassmorphism**: Các thành phần giao diện mờ ảo, hiện đại.
- **Micro-animations**: Hiệu ứng chuyển động mượt mà khi tương tác.
- **Dark Mode Ready**: Cấu trúc dễ dàng mở rộng sang chế độ tối.

---

*Phát triển và duy trì bởi **[Trần Duy Phát](https://github.com/DuyPhatpeo)***
