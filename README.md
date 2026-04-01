# 🚀 LinkSnap v3.1 Premium - URL Shortener & Analytics

Hệ thống rút gọn liên kết hiện đại với trải nghiệm người dùng cao cấp và khả năng phân tích dữ liệu chuyên sâu.

**🌐 Live Demo:** [https://linksnap.free.laravel.cloud/](https://linksnap.free.laravel.cloud/)

---

## ● Project Overview

LinkSnap là giải pháp quản lý liên kết toàn diện, giúp biến các URL dài thành các mã ngắn gọn. Hệ thống tích hợp bộ công cụ phân tích thời gian thực để theo dõi hiệu quả click, đối tượng truy cập và xu hướng tăng trưởng.

## ● Features Implemented

- **Rút gọn thông minh**: Tạo link ngắn tức thì, hỗ trợ mã tùy chỉnh (Custom Alias) cho người dùng đã đăng nhập.
- **Phân tích chuyên sâu (Deep Analytics)**:
  - Biểu đồ tăng trưởng 14 ngày (Area Chart).
  - Thống kê tỷ lệ Hệ điều hành (Windows, MacOS, Android, iOS...) và Trình duyệt.
  - Chỉ số thời gian thực: Tổng click, Click trong ngày, Visitors duy nhất (IP).
- **Quản lý Link nâng cao**: Tìm kiếm thời gian thực, xóa liên kết, cập nhật URL gốc và Reset thống kê.
- **Trải nghiệm Premium**: Giao diện Glassmorphism (kính mờ), Header Sticky, và hệ thống phân trang tùy chỉnh mượt mà.
- **Mã QR thông minh**: Tự động tạo và hỗ trợ tải về mã QR cho mỗi liên kết.

## ● Tech Stack

- **Backend**: Laravel 11.x (PHP 8.2+).
- **Frontend**: Tailwind CSS, Vanilla JavaScript (ES6+), Chart.js (Biểu đồ).
- **Database**: MySQL / MariaDB.
- **Integrations**: QR Server API.

## ● Architecture Overview

- **Mô hình**: MVC (Model-View-Controller) chuẩn Laravel.
- **Presentation Layer**: Sử dụng Blade Components và Partials để tối ưu mã nguồn giao diện.
- **Internal Data Flow**: Dashboard cập nhật dữ liệu qua AJAX (Fetch API) không cần tải lại trang.
- **Security**: Hệ thống xác thực bằng Middleware để bảo mật dữ liệu người dùng.

## ● API Design

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| `POST` | `/api/shorten` | Tạo liên kết rút gọn mới |
| `GET` | `/api/stats` | Lấy danh sách link (có hỗ trợ search) |
| `GET` | `/api/logs` | Lấy 15 nhật ký truy cập toàn cục gần nhất |
| `GET` | `/api/chart` | Dữ liệu biểu đồ & metric tổng quan Dashboard |
| `GET` | `/api/links/{id}` | Lấy chi tiết thống kê JSON của 1 link |
| `PATCH` | `/api/links/{id}` | Cập nhật URL gốc của liên kết |
| `POST` | `/api/links/{id}/reset` | Xóa sạch thống kê và nhật ký của link |
| `DELETE` | `/api/delete/{id}` | Xóa vĩnh viễn liên kết |
| `GET` | `/{short_code}` | Engine điều hướng (Redirect Service) |

## ● Data Model

- **Users**: Lưu trữ thông tin định danh và tài khoản.
- **Links**: Lưu URL gốc, mã rút gọn và quan hệ với người dùng.
- **LinkLogs**: Lưu vết chi tiết mỗi lần click (IP, thiết bị, trình duyệt) gắn với Link.

## ● How to Run

1. **Clone Repo**: `https://github.com/DuyPhatpeo/rutgonlink.git`
2. **Cài đặt**: `composer install`
3. **Cấu hình**: Tạo `.env`, cập nhật thông tin Database và chạy `php artisan key:generate`.
4. **Khởi tạo bảng**: `php artisan migrate`.
5. **Chạy ứng dụng**: `php artisan serve`.

---
*© 2024 LinkSnap - Phát triển với sự tâm huyết bởi **Trần Duy Phát***
