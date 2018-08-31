<?php
require_once 'inc/init.inc.php';
$contenu = '';
// 1- connexion à la bdd :
$pdo = new PDO('mysql:host=localhost;dbname=gestion_rh', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


if (!empty($_POST)) {  // si $_POST est rempli c'est que le formulaire a été soumis

    // Contrôles sur le formulaire :
    

    if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) $contenu .= '<div class="bg-danger">Le nom doit comporter entre 2 et 20 caractères.</div>';

    if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) $contenu .= '<div class="bg-danger">Le prénom doit comporter entre 2 et 20 caractères.</div>';

    if (!isset($_POST['date_naissance']) || !ctype_digit($_POST['date_naissance']) || $_POST['date_naissance'] < date('d-m-Y') || $_POST['date_naissance'] > date('d-m-Y')) $contenu .= '<div class="bg-danger">La date de naissance est incorrecte.</div>';

    if (!isset($_POST['civilite']) || ( $_POST['civilite'] != 'm' && $_POST['civilite'] != 'f'))  $contenu .= '<div class="bg-danger">Le type doit être conforme à la liste.</div>';

    if (empty($_POST['poste']) || strlen($_POST['poste']) < 2 || strlen($_POST['poste']) > 20) $contenu .= '<div class="bg-danger">Le poste doit être rempli.</div>';


    if (empty($contenu)) {
        // Afficher un message de réussite ou d'échec :
        $result = $pdo->prepare("INSERT INTO salaries (nom, prenom, date_naissance, civilite,  poste) VALUES (:nom, :prenom, :date_naissance, :civilite, :poste)");

            $result->bindParam(':nom', $_POST['nom']);
            $result->bindParam(':prenom', $_POST['prenom']);
            $result->bindParam(':date_naissance', $_POST['date_naissance']);
            $result->bindParam(':civilite', $_POST['civilite']);
            $result->bindParam(':poste', $_POST['poste']);
    

        $req = $result->execute();  // la méthode execute() renvoie un booléen selon que la requête a marché (true) ou pas (false)



            if ($req) {
                $contenu .= '<div>Le salarié a bien été ajouté.</div>';
            } else {
                $contenu .= '<div>Une erreur est survenue lors de l\'enregistrement.</div>';
            }
    }

   
    
}


// Préambule à l'exercie :

$aujourdhui = date('d-m-Y'); // donne la date du jour au format indiqué

//-----------
// Convertir une date d'un format vers un autre :
$date = '2018-08-24';

$objetDate = new DateTime($date);
$naissanceDate = $objetDate->format('d-m-Y'); // la méthode format() permet de convertir un objet date selon le format indiqué

echo '<hr>';


    
var_dump($_POST);


//------------------ AFFICHAGE ------------------
require_once 'inc/haut.inc.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion RH</title>
</head>
<body>
    <h1 class="mt-4">Gestion personnel</h1>
    <?php echo $contenu?>
<form method="post">

    <div>
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value=""><br>
    </div>
    <div>
        <label for="prenom">Prenom</label>
        <input type="text" name="prenom" id="prenom" value=""><br>
    </div>
    <div>
        <label for="date_naissance">Annee de naissance</label>
        <?php
            echo '<input type="date" name="date_naissance" id="date_naissance" value="">';
        ?><br>
    </div>
    <div>
    <label for="civilite">Civilité</label>
    <select name="civilite">
        <option value="m" checked>M</option>
        <option value="f">F</option>
    </select>
    </div>
    <div>
        <label for="poste">Poste</label>
        <input type="text" name="poste" id="poste" value=""><br>
    </div>
    <div>
        <input type="submit" value="S'inscrire" class="btn">
    </div>
</form>

</body>
</html> 

<?php
require_once 'inc/bas.inc.php'; 
