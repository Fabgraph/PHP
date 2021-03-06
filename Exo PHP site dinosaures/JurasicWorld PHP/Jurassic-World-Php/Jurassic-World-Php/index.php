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
              <a class="nav-link js-scroll-trigger" href="#">fr | en</a>
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

    <section id="presentation">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2>REGARDEZ UN DINOSAURE DROIT DANS LES YEUX !</h2>
              <img src="img/entree.png" alt="" class="entree mb-3">
              <p><strong>Jurassic World/l’Exposition</strong> prolonge l’expérience des spectateurs en associant des environnements immersifs à des éléments éducatifs et scientifiques interactifs.</p>
              <p>Inspiré de l’un des plus grands blockbusters de l’histoire du cinéma, cet événement plonge petits et grands dans les scènes inspirées du célèbre film. Ici, le parc imaginaire prend vie… juste sous vos yeux.</p>
              <p>Découvrez <em>Isla Nublar</em> en classe VIP et explorez <strong>Jurassic World</strong>. Écarquillez vos yeux devant l’imposant Brachiosaure ; discutez nez à nez avec un Vélociraptor et approchez- vous du plus mauvais de tous, le terrible <em>Tyrannosaure rex</em>.</p>
              <p>Créée en étroite collaboration avec un paléontologue renommé, Jack Horner, l’exposition est riche en contenus interactifs et éducatifs issus de recherches scientifiques sur l’ADN des dinosaures, autant de découvertes qui ont permis à <strong>Jurassic World</strong> de prendre vie. Quel que soit votre âge, ces créatures préhistoriques incroyables n’auront plus aucun secret pour vous.</p>

              <div class="text-center">
                  <p class="adresse">Jurassic World : Un voyage à couper le souffle ! du 14 Avril au 2 Septembre 2018 à la Cité du Cinéma Paris / Saint-Denis</p>
              </div>
              <div class="text-center">
                  <p class="adresse">Réservez vos places dès aujourd’hui, et souvenez-vous... si quelque chose vous poursuit, <strong>COUREZ!</strong></p>
                  <a class="btn btn-primary billeterie m-4" href="reservation.php" role="button">RESERVER</a>
              </div>
          </div>
        </div>
      </div>
    </section>

    <section id="informations" class="bg-light">
      <div class="container">
        <div class="row">
            <div class="col-sm mx-auto">
                <h3><i class="far fa-credit-card"></i> Tarifs</h3>
                <ul class="liste">
                    <li>Adulte: <strong>19.90 €</strong></li>
                    <li>Enfant(- de 11 ans): <strong>15.90 €</strong></li>
                    <li>Famille(2 adultes + 2 enfants): <strong>64.90 </strong>€</li>
                    <li>Audioguide: <strong>5 €</strong></li>
                </ul>

                <p>Possibilité de réserver un billet coupe file prioritaire par tranches horaires de 30 minutes.</p>

                <div class="text-md-left">
                    <a class="btn btn-primary billeterie m-0" href="#" role="button">RESERVER</a>
                </div>
            </div><!-- fin col-sm mx-auto -->

            <div class="col-sm mx-auto  ">
                <h3><i class="fas fa-bus-alt"></i> Comment venir?</h3>
                <p class="lead">Cité du cinéma 20 Rue Ampère 93200 Saint-Denis</p>
                <ul class="liste">
                    <li><strong>En Métro</strong>: M 13 (Carrefour Pleyel)</li>
                    <li><strong>En Bus</strong>: Ligne 139 (arrêt rue Ampère)</li>
                    <li><strong>En voiture</strong>: via l'autoroute A1 (sortie 2 vers Saint-Denis/La Plaine/Saint-Denis-Centre) ou via l'autoroute A86 (sortie 8a vers Saint Ouen/Paris-Porte de Clignancourt/Saint-Denis-Pleyel)</li>
                </ul>

                <div class="carte">
                    <iframe class="iframe" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=Cité+Cinéma,Saint-Denis&amp;zoom=13&amp;key=AIzaSyCjMy9HJhXa5t_M_zleUGJzsDWCZMbeNqQ" allowfullscreen=""></iframe>
                </div>
            </div><!-- fin col-sm mx-auto -->
        </div><!-- fin row -->
      </div><!-- fin cantainer -->
    </section>

    <section id="presse">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <h3>partenaires</h3>
              <ul class="list-inline">
                  <li class="list-inline-item">
                      <img src="img/tf1.png" alt="" class="logo-partenaire">
                  </li>
                  <li class="list-inline-item">
                      <img src="img/bfm.png" alt="" class="logo-partenaire">
                  </li>
                  <li class="list-inline-item">
                      <img src="img/jdd.png" alt="" class="logo-partenaire">
                  </li>
                  <li class="list-inline-item">
                      <img src="img/rtl.png" alt="" class="logo-partenaire">
                  </li>
              </ul>
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
