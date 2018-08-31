<?php
    var_dump($_POST);

    $pdo = new PDO('mysql:host=localhost;dbname=jurassicworld', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    define('RACINE_SITE', '/Jurassic_World/');

    $contenu = '';

    function executeRequete($req, $param = array()) {
        if (!empty($param)){
            foreach($param as $indice => $valeur) {
                $param[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
            }
        }

        global $pdo;
        $result = $pdo->prepare($req);
        $result->execute($param);return $result;
    }

    function validateDate($date, $format = 'd-m-Y') {
        $d = DateTime::createFromFormat($format, $date);

        if ($d && $d->format($format) == $date) {
            return true;
        } else {
            return false;
        }
    }

    if (!empty($_POST)) {
        if (!isset($_POST['inputNom']) || strlen($_POST['inputNom']) < 4 || strlen($_POST['inputNom']) > 20)
            $contenu .= '<div class="bg-danger">Le nom doit contenir entre 4 et  20 caractères.</div>';

        if (!isset($_POST['inputPrenom']) || strlen($_POST['inputPrenom']) < 4 || strlen($_POST['inputPrenom']) > 20)
            $contenu .= '<div class="bg-danger">Le prenom doit contenir entre 4 et  20 caractères.</div>';

        if (!isset($_POST['inputEmail']) || !filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL))
            $contenu .= '<div class="bg-danger">Email est incorrect.</div>';

        if (!isset($_POST['inputDate']) || !validateDate($_POST['inputDate'], 'Y-m-d'))
            $contenu .= '<div>La date n\'est pas valide.</div>';

        if (!isset($_POST['inputHeure']) || strlen($_POST['inputHeure']) < 4 || strlen($_POST['inputHeure']) > 20)
            $contenu .= '<div class="bg-danger">L\'heure n\'est pas valide.</div>';

        if (!isset($_POST['inputInfoComp']) || strlen($_POST['inputInfoComp']) < 20 || strlen($_POST['inputInfoComp']) > 2000)
            $contenu .= '<div class="bg-danger">Les doit contenir entre 20 et  2000 caractères.</div>';

        if (empty($contenu)) {
            executeRequete("INSERT INTO reservation (nom, prenom, email, date, heure, info_compl) VALUES (:nom, :prenom, :email, :date, :heure, :info_compl)",
                array(
                    ':nom'        => $_POST['nom'],
                    ':prenom'     => $_POST['prenom'],
                    ':email'      => $_POST['email'],
                    ':date'       => $_POST['date'],
                    ':heure'      => $_POST['heure'],
                    ':info_compl' => $_POST['info_compl']
                )
            );

            $contenu .= '<div class="bg-success">Votre réservation à bien été enregistrer.</div>';
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Copie du site https://www.jurassicworldexposition.fr/">
    <meta name="author" content="Samba">
    <title>Jurassic World</title>
    <!-- CSS Bootstrap -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bibliothèque d'îcones font-awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <!-- Styles personnalisé -->
    <link href="css/style.css" rel="stylesheet">
</head>

<!-- Cette mise en page utilise essentiellement les grilles de bootstrap. https://getbootstrap.com/docs/4.1/layout/grid/ -->
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navigation fixed-top" id="mainNav">
    <div class="container">
        <button class="navbar-toggler hamburger" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
        </button>
        <!-- Centrage de la navigation avec en utilisant l'offset: https://getbootstrap.com/docs/4.1/layout/grid/#offsetting-columns pour en savoir plus sur le positionnement bootstrap -->
        <div class="collapse navbar-collapse col-md-10 offset-md-1" id="navbarResponsive">
            <!-- ml-auto nous permet de gérer les marges en l'occurence la gauche dans notre cas. -> https://getbootstrap.com/docs/4.1/utilities/flex/#auto-margins pour en savoir plus sur la gestion des marges -->
            <ul class="navbar-nav ml-2 menu">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#presentation">L'exposition</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#informations">infos pratiques</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#">faq</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#">avis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#presse">presse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#">fr|en</a>
                </li>
            </ul>
            <!-- Ici j'utilise .float-right pour positionné le bouton qui en fait est un lien. https://getbootstrap.com/docs/4.1/utilities/float/ -->
            <a class="btn btn-primary float-right billeterie" href="#" role="button"><i class="fas fa-ticket-alt fa-lg"></i> Billeterie</a>
        </div>
    </div>
</nav>

<header class="bg">
    <div class="container text-center">
        <img src="img/logo.png" alt="" class="logo">
        <img src="img/climatise.png" alt="" class="ruban">
    </div>
</header>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <h2 class="text-center">Réserver maintenant !!</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="inputNom">Nom</label>
                                    <input type="text" class="form-control" id="inputNom" name="nom" placeholder="Nom">
                                </div>
                            </div>

                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="inputPrenom">Prénom</label>
                                    <input type="text" class="form-control" id="inputPrenom" name="prenom" placeholder="Prénom">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="inputEmail1">Email</label>
                                <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" placeholder="exemple@exemple.com">
                                <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre email avec quiconque.</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="inputDate">Date</label>
                                    <input type="date" class="form-control" id="inputDate" name="date" placeholder="Date">
                                </div>
                            </div>

                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="inputHeure">Heure</label>
                                    <input type="time" class="form-control" id="inputHeure" name="heure" placeholder="Date">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputInfoComp">Informations complémentaire</label>
                                    <textarea class="form-control" id="inputInfoComp" name="info_compl" placeholder="Nous serons une dizaiine"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary billeterie mb-5">Réserver</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="py-5 footer">
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <img src="img/logo-vhe.png" alt="">
                    </li>
                    <li class="list-inline-item">
                        <img src="img/logo-cityneon.png" alt="">
                    </li>
                    <li class="list-inline-item">
                        <img src="img/logo-fimalac.png" alt="">
                    </li>
                    <li class="list-inline-item">
                        <img src="img/logo-encoreprod.png" alt="">
                    </li>
                    <li class="list-inline-item">
                        <img src="img/logo-universal.png" alt="">
                    </li>
                </ul>

                <p>TM & © Universal Studios et Amblin. Jurassic World est une marque déposée par Universal Studios et Amblin Entertainment, Inc. Tous droits réservés.</p>
                <ul class="liste menu-footer">
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Conditions Générales d'Utilisation</a></li>
                    <li><a href="#">Politique de confidentialité</a></li>
                    <li><a href="#">Cookies</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-sm">
                <ul class="list-inline menu-footer text-right">
                    <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f fa-2x"></i></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-instagram fa-2x"></i></a></li>
                </ul>

                <p class="text-right">Reproduction <i class="fas fa-heart fa-lg"></i> by Samba</p>
            </div>
        </div>
    </div>
    <!-- /.container -->
</footer>
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom JavaScript for this theme -->
<script src="js/script.js"></script>
</body>
</html>
