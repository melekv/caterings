# Caterings
Project jest zadaniem rekrutacyjnym.

### Wykorzystane technologie
* Laravel 9
* PHP 8.1
* MariaDB 10
* Docker

### Kroki, aby uruchomić
* git clone https://github.com/melekv/caterings.git
* change `src/.env.backup` to `src/.env`
* docker-compose up -d --build
* docker exec -it server bash
* composer install
* chown -R www-data:1000 ./*
* php artisan migrate
* exit

### Opis zadania
Dane do admina: `admin` / `admin123`.\
Użytkownik na możliwość wpisania swoich danych przez:
* UI (strona główna),
* CLI (musi zostać wywołane w kontenerze `server` poleceniem:
`php artisan insert:input {email} {pesel} {imie} {nazwisko}`)
* API (do testów używałem `Postmana`) przez endpoint: `/api/user`

Aktywację pełnoletniego użytkownika wykonuje się w kontenerze `server`
poleceniem `php artisan activate:users`.