# He Thong Quan Ly Khoa Hoc (Course Management System)

He thong quan ly khoa hoc truc tuyen duoc xay dung bang Laravel, cho phep quan ly khoa hoc, bai hoc va hoc vien dang ky.

## Muc Luc
- [Tinh Nang](#tinh-nang)
- [Yeu Cau He Thong](#yeu-cau-he-thong)
- [Cai Dat](#cai-dat)
- [Cau Hinh](#cau-hinh)
- [Chay Du An](#chay-du-an)
- [Cau Truc Du An](#cau-truc-du-an)
- [Screenshots](#screenshots)
- [Tac Gia](#tac-gia)
- [License](#license)

## TINH NANG

### Quan ly Khoa hoc
- Them, sua, xoa khoa hoc (Soft Delete)
- Upload anh khoa hoc
- Trang thai khoa hoc (Draft/Published)
- Tim kiem, loc, sap xep khoa hoc
- Phan trang danh sach

### Quan ly Bai hoc
- Them bai hoc vao khoa hoc
- Quan ly noi dung, video URL
- Sap xep thu tu bai hoc

### Quan ly Hoc vien
- Dang ky khoa hoc cho hoc vien
- Tu dong tao/tim hoc vien theo email
- Thong ke so luong hoc vien tung khoa

### Dashboard
- Tong so khoa hoc, hoc vien, doanh thu
- Khoa hoc nhieu hoc vien nhat
- 5 khoa hoc moi nhat

### Tinh nang khac
- Validation du lieu dau vao
- Giao dien Bootstrap 5 responsive
- Eager Loading toi uu query
- Eloquent ORM voi Relationships

## YEU CAU HE THONG

- PHP: >= 8.0
- Composer: Latest version
- Database: MySQL/SQLite/PostgreSQL
- Web Server: Apache/Nginx (hoac XAMPP/WAMP/Laragon)
- Node.js & NPM: (Optional, cho bien dich assets)

## CAI DAT

Buoc 1: Clone repository
```bash
git clone https://github.com/hmPhongg/quanlykhoahoc_ktchuong3_cd1.git
cd quanlykhoahoc
# Cai dat PHP dependencies
composer install
Buoc 2: Cai dat dependencies
# Cai dat Node dependencies (neu co)
npm install
npm run build

Buoc 3: Cau hinh moi truong
# Copy file cau hinh mau
cp .env.example .env

# Tao application key
php artisan key:generate
Buoc 4: Cau hinh Database
Su dung MySQL
# Chinh sua file .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=quanlykhoahoc
DB_USERNAME=root
DB_PASSWORD=

# Tao database
mysql -u root -p
CREATE DATABASE quanlykhoahoc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;

# Chay migration
php artisan migrate

Buoc 5: Tao Storage Link
php artisan storage:link

Buoc 6: (Optional) Seed du lieu mau
php artisan db:seed

CAU HINH
Upload Images
Dam bao thu muc storage/app/public co quyen ghi:

# Windows (Git Bash)
chmod -R 775 storage/

# Linux/Mac
chmod -R 775 storage/
chown -R www-www-data storage/

Cache Optimization (Production)
php artisan config:cache
php artisan route:cache
php artisan view:cache

CHAY DU AN
php artisan serve
Truy cap: http://localhost:8000

