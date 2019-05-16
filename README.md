Informations sur le projet !

// Présentation du projet
Le but de ce projet, et de créer un petit jeux en php avec la programmation Orienté Objet
Celà a était réaliser dans les grandes lignes, mais il reste des choses à améliorer(voir liste : amélioration).

// Descriptions des fichiers
autoload.php
Ce fichier sert a chargé toutes les class dans la pile d'éxecution de php grâce au spl_autoload_register.
Il charge également la BDD

// index.php
Ce fichier charge l'ensemble du jeux, La session, pour permettre de sauvegarder sont personnage,
Un formulaire pour la création du personnage, ou pour charger sont personnage.
Une fois le personnage créer/charger, le script cache le formulaire, et fait apparaitre, une tableau de caractèristique du personnage
Ensuite on peut frapper sont adversaire, ou ce frapper soi même(Cette fonction n'ait pas inutile pour la suite du projet car on ajoutera des malus permettant de ce frapper soi même).
Grâce a un CRUD(CREATE,READ,UPDATE,DELETE), on peut injecté en BDD les différentes informations, comme la monté de niveau.
Cela affiche aussi le nombre de personnage créer.

// Personnages.php
Ce fichier gère la Class Personnages, qui répértorie, toutes les caractèristiques d'un personnages et sont ensuite initialisée pour être envoyé a la class de gestion des personnages
Ces dans ce fichier que les attributs du personnages sont initialisée, Le nom, le niveau, l'experiences, la force, la vie, est les différentes constantes qui permettes de frapper, de ce frapper, ou de mourir.

// PersonnagesManager.php
Ce fichier gère la class PersonnagesManager, qui gère la création de personnage et l'initalisation de la class Personnages lorsque l'on fait :
$personnages = new Personnages();
Elle gère également toutes les requêtes SQL(CRUD) elle injecte, ou met a jours les différentes informations des personnages, elle récupère également la listes des caractèristique des personnages, ou alors elle affiche également le nombre de personnage creer.

// Liste : Amélioration a apporté(Liste non exhaustive)
Système de niveau : Chaque personnage commence au niveau 1 et sont niveau maximum et 50, on peut donc mettre en place une fonctionnalité qui permet de monter de niveau a chaque fois que le personnage atteint 100 en experiences

Système de force : Chaque personnage commence avec 1 de force et sont maximum et de 100, on peut donc mettre en place une fonctionnalité qui permet de monté des points de force a chaque lvl up

Système de tour par tour : a l'état actuel du projet seul le personnage selectionné peut frapper et il peut frapper autant de fois qu'il veut, hors il serai intéressant de mettre en place un fonctionnement de tour par tour

Système perte de pv : a l'état actuel du projet les personnages ne perde pas de vie lorsqu'il ce frappe.

Système de Bonus/Malus : Cette fonctionnalité, sert a appliquée des bonus qui avantage le personnage ex : + de force pendant 3 tours, ou dans le cas contraire un empoisonement, qui reduit les pv pendant x tours.
