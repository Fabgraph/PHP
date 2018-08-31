<?php
/* Sujet :

1- Créer une BDD "restaurants" avec une table "restaurant" :
    id_restaurant   PK AI INT(3)
    nom             VARCHAR(100)
    adresse         VARCHAR(255)
    telephone       VARCHAR(10)
    type            ENUM('gastronomique', 'brasserie', 'pizzeria', 'autre')
    note            INT(1)
    avis            TEXT

2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un restaurant en BDD. Les champs type et note (de 1 à 5) sont des menus déroulants.

3- Effectuer les vérifications nécessaires :
    Le champ nom contient 2 caractère minimum
    Le champ adresse ne doit pas être vide
    Le téléphone doit contenir 10 chiffres
    Le type doit être conforme à la liste des types de la BDD
    La note est un nombre entier entre 0 et 5
    L'avis ne doit pas être vide
    En cas d'erreur de saisie, afficher un message au-dessus du formulaire.

4- Ajouter un ou plusieurs restaurants à la BDD et afficher un message de succès ou d'échec lors de l'enregistrement.

*/

$contenu = '';
$pdo = new PDO('mysql:host=localhost;dbname=restaurants', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$message= '';

print_r($_POST);
    if (!empty($_POST)) {  // si $_POST est rempli c'est que le formulaire a été soumis

        // Contrôles sur le formulaire :
        if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 100) $message .= '<div class="bg-danger">Le prénom doit contenir au moins 2 caractères.</div>';  
    
        if (empty($_POST['adresse'])) $message .= '<div class="bg-danger">L\'adresse est incorrect.</div>';

        if (!isset($_POST['telephone']) || !ctype_digit($_POST['telephone']) || strlen($_POST['telephone']) != 10) $message .= '<div class="bg-danger">Le telephone est incorrect.</div>';

        if (!isset($_POST['type']) || ( $_POST['type'] != 'gastronomie' && $_POST['type'] != 'brasserie' && $_POST['type'] != 'pizzeria' && $_POST['type'] != 'autre'))  $message .= '<div class="bg-danger">Le type doit être conforme à la liste.</div>';

        if (!isset($_POST['note']) || !ctype_digit($_POST['note']) || strlen($_POST['note']) == 0 || strlen($_POST['note']) <= 5 ) $message .= '<div class="bg-danger">La note est incorrect.</div>';

        if (empty($_POST['avis'])) $message .= '<div class="bg-danger">L\'avis doit être rempli.</div>';

    if (empty($message)) {

         // On échappe toutes les valeurs de $_POST :
         foreach($_POST as $indice => $valeur) {
            $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
        }



        $result = $pdo->prepare("INSERT INTO restaurant (nom, adresse, telephone, type, note, avis) VALUES (:nom, :adresse, :telephone, :type, :note, :avis) ");

            $result->bindParam(':nom', $_POST['nom']);
            $result->bindParam(':adresse', $_POST['adresse']);
            $result->bindParam(':telephone', $_POST['telephone']);
            $result->bindParam(':type', $_POST['type']);
            $result->bindParam(':note', $_POST['note']);
            $result->bindParam(':avis', $_POST['avis']);



        $req = $result->execute();  // la méthode execute() renvoie un booléen selon que la requête a marché (true) ou pas (false)


         // Afficher un message de réussite ou d'échec :
         if ($req) {
            $message .= '<div>Le restaurant a bien été ajouté.</div>';
        } else {
            $message .= '<div>Une erreur est survenue lors de l\'enregistrement.</div>';
        }
    }
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajout de restaurant</title>
</head>
<body>
    <h1>Ajout de restaurant</h1>
    <?php echo $contenu ?>

    <p>Veuillez renseigner le formulaire pour vous inscrire.</p>

    <?php echo $message ?>

<div>
    <form method="post" action="">

    <div>
        <label for="nom">Nom</label><br>
        <input type="text" name="nom" id="nom" value=""><br><br>
    </div>
    <div>
        <label for="adresse">Adresse</label><br>
        <textarea name="adresse" id="adresse"></textarea><br><br>
    </div>
    <div>
        <label for="telephone">Téléphone</label><br>
        <input type="text" name="telephone" id="telephone" value=""><br><br>
    </div>
    <div>
        <label for="type">Type</label>
        <select name="type" class="custom-select col-sm-2">
            <option>Gastronomique</option>
            <option>Brasserie</option>
            <option>Pizzeria</option>
            <option>autre</option>
        </select>
    </div>
    <div>
        <label for="note">Note</label>
        <select name="note" class="custom-select col-sm-2">
            <option>0</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>
    <div>
        <label for="avis">Avis</label><br>
        <input type="text" name="avis" id="avis" value=""><br><br>
    </div>
    <div>
        <input type="submit" name="inscription" value="s'inscrire" class="btn">
    </div>
    </form>
</div>
    
</body>
</html>