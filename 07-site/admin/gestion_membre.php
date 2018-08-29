<?php
require_once '../inc/init.inc.php';
// Exercice :
/*  Vous allez créer la page de gestion des membres dans le back-office :
    1- Seul les admin ont accès à cette page. Les autres sont redirigés vers connexion.php. 
    2- Afficher dans cette page tous les membres inscrits sous forme de table HTML, avec toutes les infos SAUF le mot de passe.
    3- Afficher le nombre de membres.
*/


// 1- On vérifie si membre est admin :
    if(!internauteEstConnecteEtAdmin()) {
        header('location:../connexion.php'); // si pas admin, on le redirige vers la page d econnexion
        exit();
    }

// 2- Affichage des membres dans le back-office :

$resultat = $pdo->query("SELECT id_membre, pseudo, nom, prenom, email, civilite, ville, code_postal, adresse, statut FROM membre");

// 3- Afficher le nombre de membres
$contenu .= '<br>';
$contenu .= '<p>Le nombre de membres est de '. $resultat->rowCount() .'.</p>';
$contenu .= '<br>';
$contenu .= '<table border="1">';

    // La ligne d'entêtes :

    $contenu .= '<tr>';

        $contenu .= '<th>id membre</th>';

        $contenu .= '<th>pseudo</th>';

        $contenu .= '<th>nom</th>';

        $contenu .= '<th>prenom</th>';

        $contenu .= '<th>email</th>';

        $contenu .= '<th>civilite</th>';

        $contenu .= '<th>ville</th>';

        $contenu .= '<th>code postal</th>';

        $contenu .= '<th>adresse</th>';

        $contenu .= '<th>statut</th>';


    $contenu .= '</tr>';

    while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
        // debug($ligne);
         $contenu .= '<tr>';
             // affichage des infos de chaque ligne $ligne :
             foreach($ligne as $indice => $info) {
                $contenu .= '<td>' . $info . '</td>';
             }
 
 
         $contenu .= '</tr>';
         
     }
    
$contenu .= '</table>';




    



//------------------- AFFICHAGE ------------------
require_once '../inc/haut.inc.php';
?>
     <h1 class="mt-4">Gestion membres</h1>

<?php
echo $contenu;
require_once '../inc/bas.inc.php';