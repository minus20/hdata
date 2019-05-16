# H-Data

Рейтинг фирм на основе оценки пользователей. Бэкенд - api c аутентификацией по токену, фронтенд - SPA на Vue 2

## Api, маршруты

В корневом маршруте находится файл с SPA, маршруты с префиксом api соответственно используются для api.
Требуется настройка веб-сервера для редиректа всех запросов кроме api в корневой маршрут. Возможен вариант настройки,
когда запросы с заголовком `"Accept: application/json"` могут проходить куда угодно, все остальные перенаправляются на
корневой маршрут.

```
+--------+----------+---------------+------+-------------------------------------------------------+--------------+
| Domain | Method   | URI           | Name | Action                                                | Middleware   |
+--------+----------+---------------+------+-------------------------------------------------------+--------------+
|        | GET|HEAD | /             |      | Closure                                               | web          |
|        | POST     | api/companies |      | App\Http\Controllers\CompanyController@store          | api,auth:api |
|        | GET|HEAD | api/companies |      | App\Http\Controllers\CompanyController@index          | api          |
|        | POST     | api/login     |      | App\Http\Controllers\Auth\LoginController@login       | api,guest    |
|        | POST     | api/logout    |      | App\Http\Controllers\Auth\LoginController@logout      | api,auth:api |
|        | POST     | api/register  |      | App\Http\Controllers\Auth\RegisterController@register | api,guest    |
|        | GET|HEAD | api/reviews   |      | App\Http\Controllers\ReviewController@index           | api          |
|        | POST     | api/reviews   |      | App\Http\Controllers\ReviewController@store           | api,auth:api |
|        | GET|HEAD | api/users     |      | App\Http\Controllers\UserController@index             | api          |
+--------+----------+---------------+------+-------------------------------------------------------+--------------+

```
Данное api упрощено и используется для взаимодействия SPA с сервером, а точнее клиентской части приложения, 
т.е. предоставляет только базовые возможности пользователей.

Если на машруте используется middleware auth:api, то в запрос следует включить токен аутентификации 
в заголовке `Authorization: Bearer <token>` или параметр `api_token` в теле запроса

### Примеры запросов и ответов
Все запросы выполняются с заголовками `Accept: application/json`, `Content-Type: application/json`.

Коды ответа:
* `200` - запрос успешно выполнен
* `201` - ресурс успешно создан
* `401` - пользователь не авторизован
* `422` - ошибка валидации данных
* `500` - ошибка сервера

#### Запрос на регистрацию пользователя

```http request
POST http://127.0.0.1:8000/api/register

{
    "name": "John Snow",
    "email": "john@snow.com",
    "password": "starksrock",
    "password_confirmation": "starksrock"
}
```

#### Вход пользователя/получение токена

```http request
POST http://127.0.0.1:8000/api/login

{"email":"john@snow.com", "password": "johnsnow"}
```

#### Выход пользователя/удаление токена
```http request
POST http://127.0.0.1:8000/api/logout
Authorization: Bearer <token>
```
#### Создание компании
```http request
POST http://127.0.0.1:8000/api/companies
Authorization: Bearer <token>

{"name": "<script>alert('boo!');</script>"}
```

#### Создание отзыва
```
POST http://127.0.0.1:8000/api/reviews
Authorization: Bearer <token>

{"company_id": 999, "rating":  4, "comment":  "meh"}
```
