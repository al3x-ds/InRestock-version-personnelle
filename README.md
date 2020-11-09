# InRestock - Projet de fin de formation oClock - Version Alex

J'ai décidé de refaire ce projet à ma façon tout en récupérant la majorité des élements.
Je trouvais l'ancienne version un peu "lourde" en intéractions, trop d'actions étaient nécessaires à l'utilisateur, cela allait limite a l'encontre du but du projet.

Ce projet est réalisé avec le framework Symfony et inclus du Javascript.

## Instalation 

J'ai crée fixtures permettant de géneré des utilisateurs et des produits. 

### Utilisateurs : 
username = admin, password = admin   
username = user, password = user


- ``` git clone ``` 
- ``` cd AlexProject ``` 
- ``` composer install ``` -- installation des dépendances du projets
- ``` modifier vos informations de connexion BDD dans le fichier .env ```
- ``` php bin/console doctrine:database:create ``` -- Commande permettant de crée la base de données
- ``` php bin/console fixtures:load ``` -- permet de charger les données de tests
- ``` php bin/console server:run ``` -- Lancer le serveur de Symfony 





