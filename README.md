# CRM LARAVEL
## Быстрый старт
### 1 Клонировать проект
```bash
git clone https://github.com/jakhongirkhuja/smartCRM.git
```

```bash
cd smartCRM
cp .env.example .env
```
### 2 Обновите в .env:
```bash
APP_URL=http://localhost:8097

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=smartkzdb
DB_USERNAME=user1
DB_PASSWORD=changeme

SESSION_DRIVER=file
```

```bash
docker-compose up -d

docker-compose exec php composer install
docker-compose exec php php artisan optimize
docker-compose exec php php artisan migrate
docker-compose exec php php artisan db:seed
docker-compose exec php php artisan test
```
### 3 Откройте проект в браузере:
```bash
http://localhost:8097
```

#### Реализации
Поддерживается Docker окружение
Используется  Repository + Service (для разделения логики)
Реализованы роли и права через Spatie Permission (Самый доступный пакет для реализации ролей)
Реализованы функции просмотра и сохранения файлов с помощью Spatie Media Library
Можно встраивать iframe-форму на сторонние сайты

### 4 Пример использование iframe

```bash
<iframe src="http://site.com/widget" width="700" height="900"></iframe>
```
### 4 Основные возможности

1)Создание и просмотр тикетов<br>
2)Управление статусами заявок<br>
3)Авторизация с ролями admin и manager<br>
4)Поддержка тестов