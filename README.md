# mvc-tmnt
Architecture MVC - mise en projet BACK (ici l'exercice que je m'étais fixé etait de pouvoir faire un modèle générique de backoffice, qui s'auto alimente en fonction du nombre de tables de la base de données, du nombre de colonnes etc.. chaque page du back office propose donc des tableau pour ajouter/supprimer/mettre a jour des "produits" qu'il trouve tout seul dans la base de donnée et ce peu importe le projet. Il n'y a donc plus rien d'autre à faire que de bien renseigner la base de donnée à la création du projet et le modèle s'occupe du reste). Ce back alimente un front "simple" (ici c'est un modèle simple de front avec une home qui donne quelques produits, des liens dans le nav qui donne accès a la liste de produits ou des types de produit, et l'affichage du détail d'un produit) l'idée de ce projet était principalement de pouvoir créer 2 modèles de sites FRONT et BACK le plus automatisés possibles (un peu façon CMS mais tout codé à la main en php). Ce projet respecte l'architecture MVC et utilise Altorouter et Altodispatcher pour la gestion des routes vers les différents controllers/models.

quelques images :
---
FRONT : 

![tmnt-front-img1](https://github.com/patmulot/mvc-tmnt/blob/main/tmnt-front-img1.JPG)
---
![tmnt-front-img2](https://github.com/patmulot/mvc-tmnt/blob/main/tmnt-front-img2.JPG)

---
BACK : 

![tmnt-back-img1](https://github.com/patmulot/mvc-tmnt/blob/main/tmnt-back-img1.JPG)
---
![tmnt-back-img2](https://github.com/patmulot/mvc-tmnt/blob/main/tmnt-back-img2.JPG)
---
![tmnt-back-img3](https://github.com/patmulot/mvc-tmnt/blob/main/tmnt-back-img3.JPG)
