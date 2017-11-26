<p align="center">GithubApi
</p>

## Les étapes de création

 - mettre en place le thème.
 - éditer les interfaces qu'on compte utiliser, à savoir la page de recherche et profil, tandis que la page login et création d'un compte sont fournies par le thème utiliser.
 - créer les routes
 - créer les Controllers avec leurs traitements.
 - intégrer le plugin githubApi dans l'application  " https://github.com/GrahamCampbell/Laravel-GitHub  "
 - Pour la gestion des favoris, on a utilisé le plugin suivant " https://github.com/ChristianKuri/laravel-favorite "
 - eon a intégré par la suite le plugin ' Guzzle, an extensible PHP HTTP client ' pour la récupération des langages avec des requêtes http. " https://github.com/guzzle/guzzle "
 - interpréter les données reçues par les Controllers dans les views (interface graphique)
 - utiliser le component multi-select du vuejs 1.

## Installation

Aprés avoir cloné ce projet dans votre répertoire, créé la base de données et édité le fichier .env de votre application suivez les instructions suivantes :

 - `composer install`
 - `php artisan migrate`
 - `php artisan db:seed`
 - `Editer le fichier : github.php se trouvant dans le chemin config/github.php avec le token
personnalisé génèré dans votre compte github et le mettre dans la partie « main »`

Maintenant vous êtes prêt.
