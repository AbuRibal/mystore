# إضافة الملف للمشروع
# Dockerfile

# استخدام الصورة الرسمية لـ PHP مع Apache من Render
FROM php:8.2-apache

# تثبيت إضافات PHP الضرورية لمشروع Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# تثبيت Composer (مدير حزم PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ضبط إعدادات Apache ليعمل مع Laravel
RUN a2enmod rewrite

# نسخ ملفات المشروع إلى مجلد العمل داخل الحاوية
COPY . /var/www/html

# تعيين مجلد العمل
WORKDIR /var/www/html

# تثبيت اعتماديات المشروع باستخدام Composer
RUN composer install --optimize-autoloader --no-dev

# تعيين الصلاحيات المناسبة للمجلدات
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# نسخ ملف البيئة المثال وإعداد مفتاح التطبيق
RUN cp .env.example .env && php artisan key:generate

# تعيين المنفذ الذي سيستخدمه Apache
EXPOSE 80