# LinkSnap - URL Shortener

LinkSnap là một hệ thống rút gọn liên kết hiện đại, được thiết kế với giao diện cao cấp và tập trung tối đa vào trải nghiệm người dùng cùng khả năng phân tích dữ liệu mạnh mẽ.

**Live Demo:** [https://linksnap.free.laravel.cloud/](https://linksnap.free.laravel.cloud/)

## ● Project Overview

LinkSnap không chỉ đơn thuần là một công cụ rút gọn link. Đây là một nền tảng quản lý liên kết toàn diện, cho phép người dùng tạo ra các đường dẫn ngắn gọn, dễ nhớ, đồng thời cung cấp các báo cáo chi tiết về lưu lượng truy cập trong thời gian thực. Dự án được xây dựng với mục tiêu mang lại sự chuyên nghiệp, tốc độ và tính minh bạch cho mọi liên kết được chia sẻ.

## ● Features Implemented

- **Rút gọn Link siêu tốc**: Xử lý và tạo liên kết rút gọn ngay lập tức.
- **Mã tùy chỉnh (Custom Alias)**: Cho phép người dùng tự đặt tên cho đường dẫn theo thương hiệu cá nhân.
- **Mã QR tự động**: Mỗi liên kết được tạo ra sẽ đi kèm với một mã QR chất lượng cao để tải về hoặc chia sẻ.
- **Dashboard phân tích chuyên sâu**:
  - Biểu đồ thống kê lượt click theo thời gian (Chart.js).
  - Theo dõi chi tiết log truy cập (Địa chỉ IP, Hệ điều hành, Trình duyệt).
- **Xác thực người dùng**: Hệ thống đăng ký, đăng nhập bảo mật để quản lý liên kết cá nhân.

## ● Tech Stack

- **Backend**: Laravel 11.x (PHP 8.2+)
- **Frontend**: Vanilla JavaScript (ES6+), Tailwind CSS
- **Database**: MySQL
- **QR Code**: QR Server API integration

## ● Architecture Overview

LinkSnap tuân thủ kiến trúc **Monolithic MVC** của Laravel nhưng được hiện đại hóa phần Frontend:

- **Presentation Layer**: Sử dụng Blade Components và View Partials để module hóa giao diện.
- **Logic Layer**: LinkController và AuthController xử lý các nghiệp vụ cốt lõi.
- **Internal API**: Xây dựng một lớp API nội bộ trả về JSON để Dashboard có thể cập nhật dữ liệu (thống kê, biểu đồ) mà không cần tải lại toàn bộ trang.
- **Middleware**: Sử dụng Middleware `auth` để bảo vệ các vùng dữ liệu nhạy cảm của người dùng.

## ● API Design

Hệ thống sử dụng các Endpoint API sau để giao tiếp giữa Frontend và Backend:

| Endpoint | Method | Description |
| :--- | :--- | :--- |
| `/api/login` | `POST` | Đăng nhập hệ thống |
| `/api/register` | `POST` | Đăng ký tài khoản mới |
| `/api/logout` | `POST` | Đăng xuất người dùng |
| `/api/shorten` | `POST` | Tạo liên kết rút gọn mới |
| `/api/stats` | `GET` | Lấy danh sách thống kê liên kết |
| `/api/logs` | `GET` | Lấy nhật ký truy cập (Link Logs) |
| `/api/chart` | `GET` | Lấy dữ liệu biểu đồ tăng trưởng |
| `/api/delete/{id}` | `DELETE` | Xoá liên kết khỏi hệ thống |
| `/{short_code}` | `GET` | Endpoint điều hướng (Main Redirect Engine) |

## ● Data Model

Cấu trúc cơ sở dữ liệu chính gồm 3 thực thể quan trọng:

1. **User**: Quản lý thông tin tài khoản (id, name, email, password).
2. **Link**: Lưu trữ thông tin liên kết (id, user_id, original_url, short_code, clicks).
3. **LinkLog**: Lưu vết mỗi lượt truy cập (id, link_id, ip_address, user_agent - dùng để phân tích OS/Browser).

## ● How to Run

### Yêu cầu hệ thống

- PHP >= 8.2
- Composer
- MySQL

### Các bước cài đặt

1. **Clone dự án**:

   ```bash
   git clone <your-repo-url>
   cd rutgonlink
   ```

2. **Cài đặt dependencies**:

   ```bash
   composer install
   ```

3. **Cấu hình môi trường**:
   - Sao chép tệp `.env.example` thành `.env`.
   - Cấu hình thông tin kết nối Database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4. **Khởi tạo ứng dụng**:

   ```bash
   php artisan key:generate
   php artisan migrate
   ```

5. **Chạy ứng dụng**:

   ```bash
   php artisan serve
   ```

   Truy cập tại: `http://127.0.0.1:8000` hoặc trải nghiệm trực tiếp tại: [https://linksnap.free.laravel.cloud/](https://linksnap.free.laravel.cloud/)

---
*Dự án được phát triển bởi **Trần Duy Phát***
