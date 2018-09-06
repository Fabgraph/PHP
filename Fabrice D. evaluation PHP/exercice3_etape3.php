<?php

$contenu = '';
// 1- connexion à la bdd :
$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
// 2- requête SQL :
$liste = $pdo->query("SELECT title, producer, year_of_prod FROM movies");

// 3- Afficher le nombre de contacts
$contenu .= '<br>';
$contenu .= '<p>Le nombre de contacts est de '. $liste->rowCount() .'.</p>';
$contenu .= '<br>';
$contenu .= '<table border="1">';

    // La ligne d'entêtes :

    $contenu .= '<tr>'; 

        $contenu .= '<th>title</th>';

        $contenu .= '<th>producer</th>';

        $contenu .= '<th>year of prod</th>';

    $contenu .= '</tr>';

    while($ligne = $liste->fetch(PDO::FETCH_ASSOC)) {
        // print_r($ligne);
         $contenu .= '<tr>';
             // affichage des infos de chaque ligne $ligne :
             $contenu .= '<td>'. $ligne['title'] .'</td>';
             $contenu .= '<td>'. $ligne['producer'] .'</td>';
             $contenu .= '<td>'. $ligne['year_of_prod'] .'</td>';
 
             $contenu .= '<td><a href="?id_movie='. $ligne['id_movie'] .'"  onclick="return(confirm(\'Voulez-vous voir les détails du contact ?\'))">details</a></td>';  // $ligne['id_produit'] contient l'id de chaque produit à chauqe tour de boucle while : ainsi le lien est dynamique, l'id passé en GET change selon le produit sur lequel je clique
        
         $contenu .= '</tr>';

        }    
$contenu .= '</table>';


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des films</title>
</head>
<body>
    <h1>Liste des films</h1>
    <?php echo $contenu ?>
</body>
</html>