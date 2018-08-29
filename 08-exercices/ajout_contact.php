<?php
/* Sujet :
1- Créer une base de données "contacts" avec une table "contact" :
    id_contact      PK AI INT(3)
    nom             VARCHAR(20)
    prenom          VARCHAR(20)
    telephone       VARCHAR(10)
    annee_rencontre YEAR
    email           VARCHAR(255)
    type_contact    ENUM('ami', 'famille', 'professionnel', 'autre')

2- Créer un formulaire HTML (avec doctype...) afin d'ajouter des contacts dans la BDD. Le champ année est un menu déroulant de l'année en cours à 100 ans en arrière à rebours, et le type de contact est aussi un menu déroulant.

3- Sur le formulaire, effectuer les contrôles nécessaires :
    -les champs nom et prénom contiennent 2 caractère minimum
    -le champ téléphone contient 10 chiffre
    -l'année de rencontre doit être une année valide
    -le type de contact doit être conforme à la liste des contacts
    -l'email doit être valide

    En cas d'erreur de saisie, afficher les messages d'erreurs au-dessus du formulaire.

4- Ajouter les contacts à la BDD et afficher un message en cas de succès ou en cas d'échec.
*/
// 3- Traitement du formulaire :
    $pdo = new PDO('mysql:host=localhost;dbname=contact', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    $message = '';
    print_r($_POST);
    if (!empty($_POST)) {  // si $_POST est rempli c'est que le formulaire a été soumis

        // Contrôles sur le formulaire :
        if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) $message .= '<div>Le prénom doit comporter entre 2 et 20 caractères.</div>';  // on vérifie si l'indice "prenom" existe bien, s'il n'existe pas on met un message à l'internaute. On vérifie aussi sa longueur qui doit être comprise entre 3 et 20 caractères
    
        if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) $message .= '<div>Le nom doit comporter entre 2 et 20 caractères.</div>';

        if (!isset($_POST['telephone']) || !ctype_digit($_POST['telephone']) || strlen($_POST['telephone']) != 10) $message .= '<div>Le telephone doit être de 10 chiffres.</div>';

        if (!isset($_POST['annee_rencontre'])) $message .= '<div>Une année doit être sélectionnée.</div>';

        if (!isset($_POST['type_contact']) || ( $_POST['type_contact'] != 'Ami' && $_POST['type_contact'] != 'Famille' && $_POST['type_contact'] != 'Professionnel' && $_POST['type_contact'] != 'Autre'))  $message .= '<div>Le type doit être conforme à la liste.</div>';

        if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $message .= '<div class="bg-danger">Email est incorrect.</div>'; 

        if (empty($message)) {  // si $message est vide c'est qu'il n'y a pas d'erreur

            // On échappe toutes les valeurs de $_POST :
            foreach($_POST as $indice => $valeur) {
                $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
            }
    
            // On fait une requête préparée :
            $result = $pdo->prepare("INSERT INTO contact (nom, prenom, telephone, annee_rencontre, email, type_contact) VALUES (:nom, :prenom, :telephone, :annee_rencontre, :email, :type_contact) ");
    
            $result->bindParam(':prenom', $_POST['prenom']);
            $result->bindParam(':nom', $_POST['nom']);
            $result->bindParam(':telephone', $_POST['telephone']);
            $result->bindParam(':annee_rencontre', $_POST['annee_rencontre']);
            $result->bindParam(':email', $_POST['email']);
            $result->bindParam(':type_contact', $_POST['type_contact']);
            
            $req = $result->execute();  // la méthode execute() renvoie un booléen selon que la requête a marché (true) ou pas (false)
    
            // Afficher un message de réussite ou d'échec :
            if ($req) {
                $message .= '<div>Le contact a bien été ajouté.</div>';
            } else {
                $message .= '<div>Une erreur est survenue lors de l\'enregistrement.</div>';
            }
        } // fin du if (empty($message))
    }

           
       echo $message; 
?>


<form method="post">

    
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" value=""><br>
    <label for="prenom">Prenom</label>
    <input type="text" name="prenom" id="prenom" value=""><br>
    <label for="telephone">Telephone</label>
    <input type="text" name="telephone" id="telephone" value=""><br>
    <?php
    echo '<select name="annee_rencontre">';
    for ($annee = 2018; $annee >= 1918; $annee--) {
        echo '<option>' . $annee . '</option>';
    }
    echo '</select>';

    echo '<br>';
    ?>
    <label for="email">Email</label>
    <input type="text" name="email" id="email" value=""><br>
    <label for="type_contact">Type</label>
    <select name="type_contact">
        <option>Ami</option>
        <option>Famille</option>
        <option>Professionnel</option>
        <option>Autre</option>
    </select>
    <input type="submit" value="S'inscrire" class="btn">
</form>