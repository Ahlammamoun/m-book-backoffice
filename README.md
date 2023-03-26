# m-book-backoffice

## Projet _Dans M'book_

## Description du projet

Un client veut créer un site de e-commerce, en l'occurence une boutique de livres de secondes main.  
Le site va probablement s'appeller m'book , mais le nom de code du projet est pour l'instant : **book**.

## Brief client

### Sur toutes les pages

En bas de chaque page, il y aura :

- le nom de la boutique
- les liens vers les pages de la boutique sur les réseaux sociaux
- 5 langues d'écriture
- 5 états de livre
- la mise en avant du fait que livraison et retours sont gratuits, que les clients ont 30 jours pour renvoyer leur produit, que les internautes peuvent contacter notre service client au 01 02 03 04 05 de 8h à 19h, du lundi au vendredi
- un formulaire d'inscription à la newsletter

### Catalogue

Voici le contenu du site prévu pour l'instant :

- une page d'accueil (avec 5 catégories mises en avant)
- une page des produits pour chaque catégorie (philosophie, recherche, policier..)
- une page produit
- une page des produits pour chaque état de produits (bon état, correct, très bon état..)
- une page des produits pour chaque langue

### BackOffice

Zone réservée aux administrateurs _business_ et techniques du site.

- l'accès à cette zone nécessite de se connecter avec son compte
- les échanges entre le navigateur et le serveur Web sont chiffrés par soucis de confidentialité & sécurité
- gestion des catégories (liste, ajout, modification, suppression)
- gestion des produits (liste, ajout, modification, suppression)
- gestion des états de produits (liste, ajout, modification, suppression)
- gestion des langues (liste, ajout, modification, suppression)
- gestion des 5 catégories en page d'accueil
- gestion des 5 états de produits en bas de page
- gestion des 5 langues en bas de page
- gestion des utilisateurs du BackOffice
- 3 types d'utilisateurs :
  - `catalog manager` pouvant gérer les données sur les produits du site (y compris catégories, états et langues)
  - `admin` pouvant, en plus de ce que peut faire un `catalog manager`

## Documents techniques

- [User stories]
- [Product backlog]
- [Intégration HTML/CSS]

## Organisation

L'organisation pour le développement du site est horizontale, et suit la méthode agile _Scrum_ (développement itératif par _Sprints_).

Il y a des rôles prédéfinis. Quel que soit son rôle, on ne donne d'ordre à personne : chaque personne qui assume un rôle s'occupe de sa partie, de ses responsabilités, en locurrence pour se projet j'ai endossé les rôles .

### Product Owner

Le Product Owner est l'unique rédacteur du _Product Backlog_.  

### Scrum Master

### Developer

### Sprints

Chaque _Sprint_ va durer une "un mois", soit 17 jours.

À la fin de chaque _Sprint_ sera livré un _Incrément_ du projet, contenant les fonctionnalités mises en place pendant ce _Sprint_ (_Sprint Backlog_).

### Daily Scrum

Chaque début de journée, les _Developers_ organisent un _Daily Scrum_ "lite" (léger) afin de savoir :

- ce que chacun a fait la veille
- ce que chacun compte faire aujourd'hui
- ce qui nous bloque, si quelque chose nous bloque

## Versions du projet

Le logiciel de versionning pour ce projet sera _Git_.

## Documentation

La documentation technique devra être rédigée **en anglais**.