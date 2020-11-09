# InRestock - Projet de fin de formation oClock - Version Alex

J'ai décidé de refaire ce projet à ma façon tout en récupérant la majorité des élements.
Je trouvais l'ancienne version un peu "lourde" en intéractions, trop d'actions étaient nécessaires à l'utilisateur, cela allait limite a l'encontre du but du projet.

Ce projet à été réalisé en 1 mois avec le framework Symfony et inclus du Javascript. 
Initialement ce projêt devait servir d'API pour un front en React, à cause de soucis dans l'équipe il a du être fait avec seulement avec Symfony.

Je pense continuer et améliorer ce projet lorsque j'aurais plus de temps afin de mettre en application les compétences que j'ai acquise mais aussi pour continuer à me former sur d'autres stack, Je pense utilisé React ou VueJS pour l'UI et Symfony pour le back-office et si possible dockeriser l'application.

## Présentation

InRestock est une application permettant de gerer les stocks d'une entreprise.
- Les administrateurs de l'entreprise ont accès à un CRUD complet des produits et des utilisateurs mais aussi à un historique des actions qui leur permet de garder un oeil sur les actions effectués par leurs employés ou eux même.
- Les utilisateurs peuvent choisir un produit et appliqué une modifications positive ou négative sur celui-ci, Le produit est mis à jour en temp réel et une nouvelle ligne est crée dans l'historique des actions. 


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





