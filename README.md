# Pt-Portal-de-Trabajo

## Teach:
* Laravel 
* php 7.4
* vue 3

## Levantar proyecto back
* crear `.env` copiando el `.env.example`
 * crear bd back-portal
  ```
    composer install
  ```
 * ejecutar migraciones
  ```
   php artisan migrate
  ```
 * ejecutar seed
```
 php artisan db:see
  ```
 * Levanta el back
 ```
php artisan serve
 ```

## Levantar proyecto Front
 * crear `.env` copiando el `.env.example`
  * installar dep
    ```
    npm i
    ```
 * Levanta el front
    ```
    npm run serve
    ```

 ### Usuario admin:
    link: http://localhost:8080/auth/login

  ```
    user: cristian@gmail.com
    password: 123456
  ```


