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
    // 1- connexion à la bdd :
    $pdo = new PDO('mysql:host=localhost;dbname=contact', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    $message = '';
    print_r($_POST);
    if (!empty($_POST)) {  // si $_POST est rempli c'est que le formulaire a été soumis

        // Contrôles sur le formulaire :
        if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) $message .= '<div class="bg-danger">Le prénom doit comporter entre 2 et 20 caractères.</div>';  // on vérifie si l'indice "prenom" existe bien, s'il n'existe pas on met un message à l'internaute. On vérifie aussi sa longueur qui doit être comprise entre 3 et 20 caractères
    
        if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) $message .= '<div class="bg-danger">Le nom doit comporter entre 2 et 20 caractères.</div>';

        if (!isset($_POST['telephone']) || !ctype_digit($_POST['telephone']) || strlen($_POST['telephone']) != 10) $message .= '<div class="bg-danger">Le telephone est incorrect.</div>';

        if (!isset($_POST['annee_rencontre']) || !ctype_digit($_POST['annee_rencontre']) || $_POST['annee_rencontre'] < (date('Y')-100) || $_POST['annee_rencontre'] > date('Y')) $message .= '<div class="bg-danger">La date est incorrecte.</div>';

        // ou :
        // on réutilise la fonction untilisateur validateDate() :
        // Validation de la date :
	/* function validateDate($date, $format = 'd-m-Y') {
		$d = DateTime::createFromFormat($format, $date);

		if ($d && $d->format($format) == $date) {
			return true;
		} else {
			return false;
		}
    }
    
    if (!isset($_POST['annee_rencontre']) || !validateDate($_POST['annee_rencontre'], 'Y')) $message .= '<div>La date est incorrecte.</div>';
    */
    

        if (!isset($_POST['type_contact']) || ( $_POST['type_contact'] != 'ami' && $_POST['type_contact'] != 'famille' && $_POST['type_contact'] != 'professionnel' && $_POST['type_contact'] != 'autre'))  $message .= '<div class="bg-danger">Le type doit être conforme à la liste.</div>';

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

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- Bootstrap Core CSS -->
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <title>Ajout contacts</title>
</head>

<body>
    <h1>Ajout contacts</h1>
<?php echo $message?>
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
        <label for="telephone">Telephone</label>
        <input type="text" name="telephone" id="telephone" value=""><br>
    </div>
    <div>
    <label for="annee">Annee</label>
    <?php
    echo '<select name="annee_rencontre">';
    for ($i = date('Y'); $i >= date('Y')-100; $i--) { // date('Y') donne l'année en cours soit 2018
        echo '<option>' . $i . '</option>';
    }
    echo '</select>';

    echo '<br>';
    ?>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value=""><br>
    </div>
    <div>
        <label for="type_contact">Type</label>
        <select name="type_contact" id="type_contact">
            <option value="ami">ami</option>
            <option value="famille">famille</option>
            <option value="professionnel">professionnel</option>
            <option value="autre">autre</option>
        </select>
    </div>
    <div>
        <input type="submit" value="S'inscrire" class="btn">
    </div>
</form>

</body>
</html>