<?php
/* Ce fichier sera inclus dans TOUS les scripts (hors inc eux m�mes) pour initialiser les �l�ments suivants :
- connexion � la BDD
- cr�er ou ouvrir une session
- d�finir le chemin absolu du site (comme dans wordpress)
- inclure le fichier fonctions.inc.php � la fin de ce fichier pour l'embarquer dans tous les scripts. */

// connexion � la BDD
$pdo = new PDO('mysql:host=localhost;dbname=gestion_rh', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// cr�er ou ouvrir une session
session_start();

// d�finir le chemin absolu du site (comme dans wordpress)
define('RACINE_SITE', '/PHP/08-exercices\Exo site gestionnaire de personnel'); //cette constante servira � cr�er les chemins absolus utilis�s dans haut.inc.php car ce fichier sera inclus dans des scripts qui se situent dans des dossiers diff�rents du site. On ne peut donc pas faire de chemin relatif dans ce fichier.

// Variables d'affichage :
$contenu = '';
$contenu_gauche = '';
$contenu_droite = '';

// Inclusion du fichier fonctions.inc.php :
require_once('fonctions.inc.php');