
![Logo](https://user-images.githubusercontent.com/84472630/187780840-2e309459-b72c-4c73-b3fe-cede2d628ee0.png)





Application web de gestion de courrier.

Ce projet fonctionne avec le Framework Laravel version 9.


## Technologies

**Client:** Laravel, PHP, Js, HTML/CSS

**Server:** Apache

**Base de données:** Mysql


## Modèle de données
![Model](https://user-images.githubusercontent.com/84472630/187789347-0085fbe9-b0e7-43a0-966b-a9a6f0af70df.png)
## Application Structure

Tout d’abord commençons par le plus basique, qu’est-ce-qu’un framework

Pour celles et ceux qui ne saurez pas encore ce qu’est un framework, il s’agit tout simplement d’un ensemble d’outils et de librairies.

Contrairement à l’utilisation d’une « simple » librairie qui a généralement un aspect et une utilisation très spécifique, le framework permet d’en rassembler plusieurs pour ainsi faire cohabiter tout ceci dans un unique « cadre de travail » (traduction littérale du mot anglais « framework »).

1. Une gestion via Composer

Mais alors comment Laravel gère-t-il tous ces composants pouvant être mis à jour et modifiés ?

C’est là que rentre en scène le gestionnaire de dépendance Composer. Je vous laisse vous renseigner directement sur le site web de Composer afin de l’installer pour ceux qui ne l’auraient pas déjà. Il vous permettra de gérer automatiquement les dépendances que votre installation Laravel aura avec d’autres composants.

Toutes ces dépendances sont répertoriées dans un simple fichier au format JSON nommé composer.json qui se trouvera à la racine de votre projet. Un exemple très simple qui vous parlera :
Pour votre projet vous aurez besoin de Laravel et donc, selon votre version de Laravel, une version de php adéquate

2. Structure de Laravel


![Logo](https://user-images.githubusercontent.com/84472630/187775729-324be808-f15b-426c-8a21-34b3156cdf90.png)



Voici une explication succincte des dossiers et fichiers les plus importants à connaitre et comprendre (vous vous en servirez très fréquemment durant le cours) :

`/app` : est le dossier où se trouve le cœur de votre application web (controllers, middlewares, facades, providers, helpers etc…)

`/config` : vos fichiers de configurations d’application, authentification, namespace, mails, base de données etc…

`/database` : Vous y trouverez notamment vos migrations (qui permettent de gérer votre base de données avec un système de versioning) ainsi que les seeds et factories (pour tester votre base de données avec des fake data).

`/public` : par convention comme pour la majorité des frameworks il s’agit du seul dossier accessible depuis le serveur où les fichiers sont accessibles depuis votre site (images, feuilles de style et scripts principalement).

`/resources` : vos assets de feuilles de style (en sass) et fichiers JS, les fichiers de langues si vous désirez un site multi-langual et l’ensemble de vos vues.

`/routes` : vous trouverez notamment le fichier web.php qui vous permettra de définir l’ensemble des routes de votre application.

`/.env` = étroitement lié au fichier /config/app.php , il définit l’environnement de l’application (base de données utilisées, nom de l’application etc…)

`composer.json` : nous l’avons vu tout à l’heure il s’agit du fichier permettant à Composer de gérer les dépendances de l’application.

Les autres dossiers et fichiers sont moins importants à connaitre pour l’instant, je ne vous demanderai pas de vous en servir, mais à titre d’information :

`/bootstrap` : demarrage de l’app.

`/storage` : dossier de stockage.

`/tests` : tests unitaires (pour éviter de tester manuellement l’application à chaque fois).

`/vendor` : Ensemble des dépendances externes.

Voilà ! Ceci est l’architecture de Laravel et votre tout premier pas dans la compréhension de sa logique bravo ! 🙂



## Installation

Prérequis
```bash
 PHP version 8
 serveur local Xampp, Wamp, Laragon
 Node Js
 Composer 
```
Si vous avez pas Composer et Node js installé sur votre machine
voila le lien [Composer](https://getcomposer.org) et [Node.js](https://nodejs.org)

Ensuite ouvrez l'editeur (Vs code, Atom, Sublimtext ) de votre choix

1. cloner le depot github

```bash
 Git clone https://github.com/Sale2021/E-courriel.git
```
Placer le a la racine de de votre serveur local

 Example: Wamp (C:\Wamp\www) ou Xampp (C:\Wamp\htdocs)
 
2. Creer une nouvelle base de données

3. Configuration du fichier .env

 ``` bash
# Allez dans votre editeur et chercher le fichier .env
app/.env.example
renomer la en .env
Ensuite ouvrez la et modifier la comme suit:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= nom de la base de données que vous venez de Creer
DB_USERNAME=root
DB_PASSWORD=

Ensuite enregistrer et fermer
```
4. Installation des  dependences

 ``` bash
#Installation des  dependences
ouvrez le terminale de votre editeur et tapez ces commande

composer install

npm install

php artisan key:generate

php artisan storage:link

php artisan migrate –seed

npm run dev
```


Ensuite ouvrez une nouvelle session du terminale
``` bash
php artisan serve

```
Ensuite allez dans phpmyadmin dans la table user
Copier email d'un l'utilisateurs de preference avec le role 'admin'

![Logo](https://user-images.githubusercontent.com/84472630/187783467-733f7f59-df13-4d63-a320-3704bb796d9a.png)




    
## Gestion des rôles utilisateurs

Noter qu’il y a différents types d’utilisateurs qui possède tous des rôles bien défini.
La solution permet de gérer les rôles des utilisateurs comme suit :

`Agent` : Tous les utilisateurs pouvant recevoir, enregistrer,mise à jour, suivre un courrier

`Rôle` : réception, enregistrement (Correspondant, Nature, courrier), mise à jour et suivie du courrier

`Secretaire` : Tous les utilisateurs pouvant réceptionner, enregistrer (Correspondant, Nature, courrier) suivre et imputer les courriers destinés à un service/département particulier au sein de l’entreprise

`Rôle` : réception, enregistrement (Correspondant, Nature, courrier), suivie, mise à jour et imputation du courrier

`Superuser` : Il s’agit des personnes auxquels un courrier est destiné plus précisément les chefs de départements/services

`Rôle` : ajout d’utilisateurs, Annotation, suivie, mise à jour et imputation du courrier

`Admin` : Toutes utilisateurs ayant tout le contrôle du système généralement Il s’agit du Directeur

`Rôle` : ajout d’utilisateurs, Département, Annotation, suivie et imputation du courrier, suppression et la mise à jour des différentes données

Ouvrez votre navigateur et entrer l'adresse http://localhost:8000
Ensuite vous allez etre rediriger vers la page de connexion


![App Screenshot](https://user-images.githubusercontent.com/84472630/187788054-8f340bd4-7580-40a2-bec6-7d3838e7ec3d.png)

Entrez email récupéré dans la table users et le mot de passe: 'password' notez que ce mot de passe est valable pour tous les autes compte

Exemple: 

email: user@gmail.com

Mot de passe: password

Bon visionnage 

## Notre Equipe

Sale Diallo,Djibril Djiré & Racine Sy

