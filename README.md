# Users App

Простое веб-приложение на Laravel для отображения, добавления и удаления пользователей. Приложение использует адаптивный дизайн и работает с AJAX-запросами.

## Требования

- PHP >= 8.1
- Composer
- Laravel 10.x

## Установка

1. Клонируйте репозиторий:

git clone https://github.com/rudkik/ajax-crud.git
2. Перейдите в каталог проекта:
3. Установите зависимости с помощью Composer:

composer install

4. Создайте файл .env, скопировав его из примера:

cp .env.example .env

5. Сгенерируйте ключ приложения:

php artisan key:generate

6. Настройте базу данных в файле .env. Замените следующие строки своими параметрами подключения:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

7. Выполните миграции для создания таблицы пользователей в базе данных:

php artisan migrate

## Запуск

Для запуска приложения выполните следующую команду:

php artisan serve


Откройте веб-браузер и перейдите по адресу http://localhost:8000

