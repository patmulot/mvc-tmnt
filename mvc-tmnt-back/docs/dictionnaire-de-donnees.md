# Dictionnaire de données

## Produits (`character`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant du personnage|
|name|VARCHAR(64)|NOT NULL|Le nom du personnage|
|description|TEXT|NULL|La description du personnage|
|picture|VARCHAR(128)|NULL|L'URL de l'image du personnage|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création du personnage|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour du personnage|
|type|entity|NULL|Le type (autre entité) du personnage|
