# Médiathèque

## Prérequis

  - PHP 7 ou plus
  - Un server local en SQL (xampp, wampp)
  - Composer
  - Node.js

## Les accès pré établis pour tester l'application

  Administrateur : 
      - email : admin@test.com
      - mot de passe : admin
  
  Employes : 
      - email : employe@test.com
      - mot de passe : Employe01!

  Inscrit : 
    - email : jean@rochefort.com
    - mot de passe : jeanrochefort

## Guide de déployement en local

Afin de déployer l'application en local sur votre apprareil suivre les instructions suivantes : 

   1. Créer un dossier dans le répertoire où se trouve votre logiciel de server local (ex: Xampp, Wampp ...).
   2. Ouvrir votre terminal et taper `git clone git@github.com:DumeGrisoni/ECF_Mediatheque.git`.
   3. Ouvrir le dossier et chercher le fichier *ecf_mediatheque.sql*.
   4. Importer le fichier *ecf_mediatheque.sql* dans le serveur local afin de créer de créer une nouvelle base de données.
   5. Ouvrir l'IDE (ex: VisualStudioCode) dans le dossier Ecf_mediatheque et décommenter dans le fichier .env la ligne *DATABSE_URL* selon le serveur utilisé. exemple : ![mysql si le serveur est en sql](../ECF_Mediatheque/Initialisation%20du%20projet/images/bd.png).
   6. Modifier les valeurs de cette ligne en entrant les données de votre serveru local:
      - db_user : votre notre d'utilisateur
      - db_password :  votre mot de passe
      - db_root: la route de votre serveur (ex: 127.0.0.1)
      - db_name : ecf_mediatheque
   7. Taper la commande suivante dans le terminal de votre IDE ouvert à la racine du projet : `composer install`
   
   Une fois les differentes dépendances dont l'application a besoin installés vous pouvez taper la commande `symfony serve -d` afin de lancer le serveur Symfony et voir l'application en direct dans votre navigateur.

## Guide de déployement sur un serveur en ligne

Afin de déployer l'application sur un serveur en ligne Heroku suivez les differentes étapes :

  1. Dans l'IDE puis dans le fichier .env modifier la ligne `APP_ENV=dev` et `APP_ENV=prod`, afin de passer en mode production.
  2. Créer un compte chez Heroku, télécharger le Heroku Cli et l'installer sur votre appareil.
  3. Dans l'IDE taper la commande `heroku login` et connectez vous.
  4. Taper `heroku create` pour créer un projet heroku. Vous pouvez ajouter après le create le nom du projet souhaité.
  5. Taper ensuite `heroku config:set APP_ENV=prod`.
  6. Déployer l'application grâce à la commande `git push heroku master`. 
  7. Sur le site d'Heroku ajouter la ressource Cleardb dans votre projet sur le site.
  8. Aller dans l'onglet Settings puis cliquer sur Reveal Config vars et les variables suivantes : 
    - APP_ENV => prod  *si celle-ci n'est pas déjà écrite*
    - DATABASE_URL => copier l'url fourni dans CLEARDB_DATABASE_URL
    - SYMFONY_ENV => prod
  9. Dans l'onglet Deploy choisir *Enable Automatic Deploy* pour que le site se deploie a chaque fois que vous ferez un git `push heroku master`.
  10. Ensuite dans le fichier .env modifier la ligne *DATABASE_URL* pour y coller l'url *CLEARDB_DATABASE_URL*
  11. Télécharger le logiciel de controle de votre base de données (ex : phpmyadmin pour mysql), créer une nouvelle connexion vers le serveur de Cleardb en y entrant les données situées dans la variable *CLEARDB_DATABASE_URL* (exemple : 
        mysql://ba52daera1d:e6dtft42@eu-cdbr-west-01.cleardb.com/heroku_81156tereeg2330?reconnect=true
        - user => ba52daera1d
        - password => e6dtft42
        - root => eu-cdbr-west-01.cleardb.com
        - db_name => heroku_81156tereeg2330 ).
  12. Une fois connecté importer le fichier *ecf_mediatheque.sql* en tant que nouvelle base de données.
  13. Dans le fichier *public/index.php* supprimer les # pour les lignes 6 à 12 puis la 14.
  14. Lancer la commande `git push heroku master`.
  15. Enfin taper la commande `heroku open`.

    


