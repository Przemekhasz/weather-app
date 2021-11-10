<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>
<img src="https://cdn.discordapp.com/attachments/819198809837273148/898173592494276608/unknown.png">

## Installation

Clone the repository-

```
git clone https://github.com/Przemekhasz/weather-app.git
```

Then cd into the folder with this command-

```
cd weatheAapp
```

Then do a composer install

```
composer install
```

Then create a environment file using this command-

```
cp .env.example .env
```

Then edit `.env` file with appropriate credential for your database server. Just edit these two parameter(`DB_DATABASE`, `API_KEY`).

Then create a database named `weather` and then do a database migration using this command-

```
php artisan migrate
```

## Run server

Run server using this command-

```
php artisan serve
```

Then go to `http://localhost:8000` from your browser and see the app.
