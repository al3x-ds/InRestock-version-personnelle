# InRestock - Version Alex

J'ai décidé de refaire ce projet à ma façon tout en récuperant la majorité des élements.
Je trouvais l'ancienne version un peu "lourde" en intéraction, trop d'actions étaient nécessaires à l'utilisateur, cela allait limite a l'encontre du but du projet.

J'ai donc voulu retirer certains fonctionnement : 
- les postes : nous nous étions "calqué" sur un modele de restaurant, nous avions donc des postes salade, pizza, etc.. Cela servait surtout à avoir un trace informatique sur les sorties et entrés des differents postes. 
- les types de prélevements (simple, inventaire, restock, etc..) 
- les catégories : nous avions ici des catégories de produits, pour réduire les changements de pages et l'interface j'ai préferé retirer ce fonctionnement, aucun produit n'a de catégories.
- les fournisseurs : Je ne sais pas trop, j'ai préferé le retirer pour alléger le code. Je me dit que cette partie est tout de même utile.

Une simple liste avec une barre de recherche est maintenant disponible dès la connexion. Je part du principe que la personne qui utilise cette application sait quel produit il veut sortir du stock.

Cette barre de recherche va venir regarder si les caractères présents sont rentré dans l'input, pour ne pas obligé l'utilisateur a rentré exactement le nom.

Exemple : En écrivant "iPhone", la fonction va venir regarder tout les produits avec ce mot, il va ainsi renvoyé tout les iphone (6, 7, 8,etc..)

Le paneau d'administration ce découpe maintenant en 3 pages : Les utilisateurs, les produits et l'historique des modifications du stock.
Les utilisateurs ont beaucoup moins d'informations, finalement le besoin n'est pas présent d'avoir des informations très détaillées sur nos utilisateurs.

Il ne me reste plus qu'a augmenté les performances du site la où celà est possible, avec nottament AJAX.


