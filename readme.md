
## A propos de ce projet

Ce projet est conçu et développé pour le test technique de l'entreprise neoweb.
Cette application est développée avec [Laravel](https://laravel.com) version 5.8.

## Installation

pour installer cette application :

- Cloner ce projet
- Tapez la commande : ```composer install```
- Créer un fichier . env et copier env.example et modifier les paramètres de votre base de données.
- Créer la base de données
- Tapez la commande : ```php artisan migrate```
- Tapez la commande : ```php artisan restaurants:fill```

La commande ```restaurants:fill``` permet de remplir la base de données avec des restaurants.

## Solution

La solution consiste à créer deux tables qui gèrent les horaires de restaurant :
- ***Calendar*** : permet de stocker les jours de la semaine du chaque restaurant avec un attribut ```type``` pour specifier si ce jours est fermé, demi-journée ou plusieurs horaires.
- ***Slots*** : comporte toutes les horaires d'une journée.

1. une liste de tous les restaurants est affichée sur la première page permettant de consulter l’horaire des restaurants ou de le mettre à jour.
2. chaque jour de la semaine est modifié séparément.
3. si vous choisissez un jour de fermeture, l'application vérifie si un autre jour est également un jour de fermeture, de sorte qu'il ne reste qu'un jour unique.
4. si vous choisissez une journée comme demi-journée, l'application vérifie si une autre journée est aussi une demi-journée, de sorte qu'il ne reste qu'une journée unique.
5. si une journée est une demi-journée, un seul horaire est autorisé.
6. Il existe deux methodes ```restaurantHasClosingDay``` et ```restaurantHasHalfDay``` pour determiner si un jour est un jour de fermeture ou une demi-jounée.
7. l'affichage de l'horaire des restaurants est ordonné par jours de la semaine.

## Technologies

- [Bootstrap 4](https://getbootstrap.com/)
- [jQuery](https://jquery.com/)
- [PHP 7.3.2](https://www.php.net/)
- [Laravel 5.8](https://laravel.com)
- [Carbon](https://carbon.nesbot.com/)
