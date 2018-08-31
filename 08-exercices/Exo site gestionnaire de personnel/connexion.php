<?php
require_once 'inc/init.inc.php';
$contenu = '';
$pdo = new PDO('mysql:host=localhost;dbname=gestion_rh', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    
var_dump($_POST);

if (!empty($_POST)) {  // si $_POST est rempli c'est que le formulaire a été soumis

    // Contrôles sur le formulaire :

    if (!isset($_POST['password']) || strlen($_POST['password'] < 2) || strlen($_POST['nom']) > 20) $contenu .= '<div class="bg-danger">Le mot de passe est requis.</div>';

    if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $contenu .= '<div class="bg-danger">Email est incorrect.</div>'; 

    

    if (empty($contenu)) {  // s'il n'y a pas d'erreur sur le formulaire
        $membre = executeRequete("SELECT * FROM admin WHERE email = :email AND password = :password", array( ':email' => $_POST['email'], ':password' => $_POST['password']));

        if ($membre->rowCount() > 0) {  // si le nombre de ligne est supérieur à 0, alors le login et le mdp existent ensemble en BDD
            // on crée une session avec les informations du membre :
                $informations = $membre->fetch(PDO::FETCH_ASSOC);  // on fait un fetch pour transformer l'objet $membre en array associatif qui contient en indices le nom de tous les champs de la requête
                debug($informations);

                $_SESSION['admin'] = $informations; // nous créons une session avec les infos du membre qui proviennent de la BDD

                header('location:ajout_salarie.php');
                exit();  // on redirige l'internaute vers sa page de profil, et on quitte ce script avec la fonction exit()

        } else {
            // sinon c'est qu'il y a erreur sur les identifiants (ils n'existent pas ou pas pour le même membre)
            $contenu .= '<div class="bg-danger">Erreur sur les identifiants.</div>';
        }

    }  // fin du if (empty($contenu))
}


//------------------ AFFICHAGE ------------------
require_once 'inc/haut.inc.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body>
    <h1 class="mt-4">Connexion</h1>
    <?php echo $contenu?>
<form method="post">
      
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
    </div>
    
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email"><br>
    </div>
    <div>
        <input type="submit" value="S'inscrire" class="btn">
    </div>
</form>

</body>
</html>  

<?php
require_once 'inc/bas.inc.php';