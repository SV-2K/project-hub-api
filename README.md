## Project Hub API

**Project Hub API** — это RESTful API, разработанное на фреймворке Laravel для управления проектами и задачами. Проект предоставляет функционал для аутентификации пользователей, управления проектами, задачами и комментариями, с поддержкой ролей и прав доступа. API подходит для использования в веб- или мобильных приложениях, где требуется организация командной работы.

### Возможности
- Аутентификация и авторизация пользователей с использованием Laravel Sanctum.
- Управление проектами: создание, редактирование, удаление, назначение пользователей.
- Управление задачами: создание, редактирование, удаление, изменение статуса.
- Комментарии к задачам для обсуждения деталей.
- Проектные роли (менеджер, исполнитель) для управления доступом.

### Технологический стек

- Laravel 12
- MySQL
- Laravel Sanctum
- PHP 8.2

### Установка

```bash
git clone https://github.com/SV-2K/project-hub-api.git
cd project-hub-api
composer install
cp .env.example .env
php artisan key:generate
# Указать параметры БД в .env
php artisan migrate
php artisan serve
```

### Эндпоинты API
#### Пользователь
- `POST /api/v1/register` — Регистрация пользователя.
- `POST /api/v1/login` — Аутентификация пользователя.
- `POST /api/v1/logout` — Выход пользователя.
- `POST /api/v1/notifications` — Уведомления пользователя.

#### Проекты
- `GET /api/v1/projects` — Список проектов.
- `POST /api/v1/projects` — Создание проекта (только администраторы).
- `GET /api/v1/projects/{id}` — Информация о проекте.
- `PUT /api/v1/projects/{id}` — Обновление проекта.
- `DELETE /api/v1/projects/{id}` — Удаление проекта.
- `POST /api/v1/projects/{id}/assign` — Назначение пользователя на проект.
- `POST /api/v1/projects/{id}/unassign` — Удаление ползователя из проекта.

#### Задачи
- `GET /api/v1/projects/{projectId}/tasks` — Список задач проекта.
- `POST /api/v1/tasks` — Создание задачи.
- `GET /api/v1/tasks/{id}` — Информация о задаче.
- `PUT /api/v1/tasks/{id}` — Обновление задачи.
- `DELETE /api/v1/tasks/{id}` — Удаление задачи.

#### Комментарии
- `POST /api/v1/tasks/{taskId}/comments` — Добавление комментария.
- `GET /api/v1/tasks/{taskId}/comments` — Список комментариев.
- `DELETE /api/v1/comments/{id}` — Удаление комментария.
