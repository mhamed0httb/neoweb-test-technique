<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## A propos de ce projet

Ce projet est conçu et développé pour le test technique de l'entreprise neoweb.
Cette application est développée avec Laravel framework version 5.8.

## Installation

pour installer cette application :

- Cloner ce projet
- tapez la commande : composer install
- tapez la commande : php artisan restaurants:fill


La commande restaurants:fill permet de remplir la base de données avec des restaurants.

## Solution

La solution consiste à créer deux tables qui gèrent les horaires de restaurant :
- Table Calendar
- Table Slots

La table Calendar permet de stocker les jours de la semaine avec un attribut type pour specifier si ce jours est fermé, demi-journée ou plusieurs horaires.

La table slots comporte toutes les horaires d'une journée.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
