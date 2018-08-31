<?php

/*
Sujet :
1- Afficher dans une table HTML (avec doctype...) la liste des contacts avec les champs nom, prénom et téléphone, et un champ supplémentaire "autres infos" qui est un lien qui permet d'afficher le détail de chaque contact.
 2- Afficher sous la table HTML, le détail du contact quand on clique sur son lien "autres infos".
*/
$contenu = '';
// 1- connexion à la bdd :
$pdo = new PDO('mysql:host=localhost;dbname=contact', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
// 2- requête SQL :
$liste = $pdo->query("SELECT id_contact, nom, prenom, telephone FROM contact");

// 3- Afficher le nombre de contacts
$contenu .= '<br>';
$contenu .= '<p>Le nombre de contacts est de '. $liste->rowCount() .'.</p>';
$contenu .= '<br>';
$contenu .= '<table border="1">';

    // La ligne d'entêtes :

    $contenu .= '<tr>'; 

        $contenu .= '<th>nom</th>';

        $contenu .= '<th>prenom</th>';

        $contenu .= '<th>telephone</th>';

        $contenu .= '<th>autres infos</th>';

    $contenu .= '</tr>';

    while($ligne = $liste->fetch(PDO::FETCH_ASSOC)) {
        // print_r($ligne);
         $contenu .= '<tr>';
             // affichage des infos de chaque ligne $ligne :
             $contenu .= '<td>'. $ligne['nom'] .'</td>';
             $contenu .= '<td>'. $ligne['prenom'] .'</td>';
             $contenu .= '<td>'. $ligne['telephone'] .'</td>';
 
             $contenu .= '<td><a href="?id_contact='. $ligne['id_contact'] .'"  onclick="return(confirm(\'Voulez-vous voir les détails du contact ?\'))">details</a></td>';  // $ligne['id_produit'] contient l'id de chaque produit à chauqe tour de boucle while : ainsi le lien est dynamique, l'id passé en GET change selon le produit sur lequel je clique
        
         $contenu .= '</tr>';

        }    
$contenu .= '</table>';
// 3- traitement de $_GET :

// var_dump($_GET);

if (isset($_GET['id_contact'])) { 

    $_GET['id_contact'] = htmlspecialchars($_GET['id_contact'], ENT_QUOTES); // pour se prémunir des injections CSS ou JS via l'url

    $resultat = $pdo->prepare("SELECT * FROM contact Where id_contact = :id_contact");
    $resultat->bindParam(':id_contact', $_GET['id_contact']);
    $resultat->execute();

    $contact = $resultat->fetch(PDO::FETCH_ASSOC); // on transforme l'objet $resultat en un array associatif $contact. Pas de boucle car on n'a qu'un suel résultat ici

    // print_r($contact);
    if (!empty($contact)) { // si $contact est vide, c'est que l'id_contact n'existe pas (ou plus)
        /*foreach ($contact as $valeur) {
            $contenu .= '<p>'. $valeur .'</p>';
        }*/

        // Version sans boucle foreach :
        $contenu .= '<p>Nom : ' . $contact['nom'] . '</p>';
        $contenu .= '<p>Prenom : ' . $contact['prenom'] . '</p>';
        $contenu .= '<p>Telephone : ' . $contact['telephone'] . '</p>';
        $contenu .= '<p>Email : ' . $contact['email'] . '</p>';
        $contenu .= '<p>Annee de rencontre : ' . $contact['annee_rencontre'] . '</p>';
        $contenu .= '<p>Type de contact : ' . $contact['type_contact'] . '</p>';

    } else {
        $contenu .= '<p>Ce contact n\'existe pas !</p>';
    }
}


    

    
   

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des contacts</title>
</head>
<body>
    <h1>Liste des contact</h1>
    <?php echo $contenu ?>
</body>
</html>