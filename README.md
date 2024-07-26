# Модуль мультирегиональности на подпапках и демонстрация его работы
- **[Cсылка на ТЗ](https://disk.yandex.ru/i/-75vpQBGXXhVFw)**

## Инструкция по запуску

1. composer install
2. npm i
3. Копировать файл .env.example и переименовать его в .env.
4. php artisan key:generate
5. Настроить подключение к sqlite (файл находится в папке database).
5. php artisan migrate
6. php artisan queue:work (если загружать данные посредством Job). Тогда нужно в MainController раскомментировать строку 15.
7. php artisan db:seed (если загружать данные посредством Seed)



### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**
