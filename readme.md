# Laravel macros "withJavascript"
## For Laravel 5
---
### Информация
Макрос, для инициализации js-переменных из контроллера. 
Был написан для хранения стейта приложения в проекте на Laravel + Vue
### Пример использования
#### Controller:
```php
return view('articles.content')
    ->with('php_var', $php_var)
    ->withJavascript([
        'user' => auth()::user(),
    ]);
```
#### Javascript:
```javascript
window.user = {"id": 12, "name": "Friend"}
```
### Установка
Скопировать макрос из файла `AppServiceProvider.php`  (линии: 19-58) в свой сервис-провайдер
