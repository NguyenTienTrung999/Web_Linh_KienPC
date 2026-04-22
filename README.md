# Dự án Web Bán Linh Kiện Máy Tính (Laravel)

Chào mừng bạn đến với dự án Website bán linh kiện máy tính. Đây là hướng dẫn chi tiết để bạn có thể cài đặt và chạy dự án trên máy cá nhân sau khi clone từ Git.

## 📋 Yêu cầu hệ thống
Trước khi bắt đầu, hãy đảm bảo máy bạn đã cài đặt:
- **PHP** >= 8.2
- **Composer** (Quản lý thư viện PHP)
- **Node.js & NPM** (Quản lý thư viện Javascript/CSS)
- **MySQL** hoặc **MariaDB** (Cơ sở dữ liệu)

## 🚀 Các bước cài đặt

### 1. Clone dự án
Mở terminal và chạy lệnh:
```bash
git clone <url_cua_repo>
cd Web_Linh_KienMayTinh
```

### 2. Cài đặt các thư viện (Dependencies)
Cài đặt thư viện PHP:
```bash
composer install
```

Cài đặt thư viện Javascript:
```bash
npm install
```

### 3. Khởi tạo Cơ sở dữ liệu (Database)

#### 3.1. Tạo Database trống
Trước khi cấu hình, bạn cần tạo một Database trống trong MySQL. Bạn có thể dùng một trong các cách sau:
- **Cách 1 (Dùng lệnh):** Mở terminal MySQL và chạy: `CREATE DATABASE WebLinhKien;`
- **Cách 2 (Dùng phpMyAdmin):** Truy cập `http://localhost/phpmyadmin`, chọn **New**, nhập tên `WebLinhKien` và nhấn **Create**.
- **Cách 3 (Dùng MySQL Workbench):** Nhấn chuột phải vào danh sách Schemas chọn **Create Schema**, đặt tên `WebLinhKien` và nhấn **Apply**.

#### 3.2. Cấu hình môi trường (.env)
Tạo file `.env` từ file mẫu:
```bash
cp .env.example .env
```
Mở file `.env` và cập nhật các thông số sau để kết nối với Database vừa tạo:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306        # Lưu ý: Đổi thành 3307 nếu bạn dùng cổng khác
DB_DATABASE=WebLinhKien
DB_USERNAME=root    # Username mặc định của XAMPP/Laragon
DB_PASSWORD=        # Password mặc định thường để trống
```

### 4. Thiết lập dữ liệu (Chọn 1 trong 2 cách)

**Cách 1: Chạy Migration (Dành cho người mới bắt đầu)**
Lệnh này sẽ tự động tạo bảng và nạp dữ liệu mẫu (Sản phẩm, Danh mục):
```bash
php artisan key:generate
php artisan migrate --seed
```

**Cách 2: Import file .sql (Nếu bạn đã có file backup dữ liệu thật)**
Nếu bạn có file `Web_LinhKien-Database.sql`, hãy dùng MySQL Workbench hoặc phpMyAdmin để **Import** file này trực tiếp vào database `WebLinhKien`. Sau đó chỉ cần chạy lệnh tạo key:
```bash
php artisan key:generate
```

### 5. Hoàn thiện cài đặt
Tạo link liên kết Storage để hiển thị hình ảnh:
```bash
php artisan storage:link
```

## 💻 Cách chạy ứng dụng

Mở 2 terminal song song:

**Terminal 1: Chạy server Laravel**
```bash
php artisan serve
```
Ứng dụng sẽ chạy tại: [http://127.0.0.1:8000](http://127.0.0.1:8000)

**Terminal 2: Chạy Vite**
```bash
npm run dev
```

---

## 🔐 Tài khoản dùng thử (Default Accounts)
Sau khi chạy lệnh `php artisan db:seed`, bạn có thể đăng nhập bằng các tài khoản sau:

### 🛡️ Trang Admin (`/admin/dashboard`)
- **Email:** `admin@example.com`
- **Password:** `password`

### 👤 Trang Người dùng (User)
- **Email:** `user@example.com`
- **Password:** `password`

## 🛠️ Công nghệ sử dụng
- **Backend:** Laravel 11.x / 12.x
- **Frontend:** Blade, Tailwind CSS, Vite, Alpine.js
- **Database:** MySQL
