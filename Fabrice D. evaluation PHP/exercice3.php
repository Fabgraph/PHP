<?php

$contenu = '';
// connexion à la BDD :
$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$message= '';

print_r($_POST);
    if (!empty($_POST)) {  // si $_POST est rempli c'est que le formulaire a été soumis

        // Contrôles sur le formulaire :
        if (!isset($_POST['title']) || strlen($_POST['title']) < 5 || strlen($_POST['title']) > 20) $message .= '<div class="bg-danger">Le titre doit contenir au moins 5 caractères.</div>';  

        if (!isset($_POST['actors']) || strlen($_POST['actors']) < 5 || strlen($_POST['actors']) > 20) $message .= '<div class="bg-danger">Le nom de l\'acteur doit contenir au moins 5 caractères.</div>';  

        if (!isset($_POST['director']) || strlen($_POST['director']) < 5 || strlen($_POST['director']) > 20) $message .= '<div class="bg-danger">Le nom du réalisateur doit contenir au moins 5 caractères.</div>'; 

        if (!isset($_POST['producer']) || strlen($_POST['producer']) < 5 || strlen($_POST['producer']) > 20) $message .= '<div class="bg-danger">Le nom du producteur doit contenir au moins 5 caractères.</div>';  
        }


        if (empty($message)) {

            // On échappe toutes les valeurs de $_POST :
            foreach($_POST as $indice => $valeur) {
               $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
           }
   
   
   
           $result = $pdo->prepare("INSERT INTO movies (title, actors, director, producer, year_of_prod, language, category, storyline, video) VALUES (:title, :actors, :director, :producer, :year_of_prod, :language, :category, :storyline, :video) ");
   
               $result->bindParam(':title', $_POST['title']);
               $result->bindParam(':actors', $_POST['actors']);
               $result->bindParam(':director', $_POST['director']);
               $result->bindParam(':producer', $_POST['producer']);
               $result->bindParam(':year_of_prod', $_POST['year_of_prod']);
               $result->bindParam(':language', $_POST['language']);
               $result->bindParam(':category', $_POST['category']);
               $result->bindParam(':storyline', $_POST['storyline']);
               $result->bindParam(':video', $_POST['video']);
   
   
   
           $req = $result->execute();  // la méthode execute() renvoie un booléen selon que la requête a marché (true) ou pas (false)
   
   
            // Afficher un message de réussite ou d'échec :
            if ($req) {
               $message .= '<div>Le film a bien été ajouté.</div>';
           } else {
               $message .= '<div>Une erreur est survenue lors de l\'enregistrement.</div>';
           }
       }
       

?>

  <!DOCTYPE html>
  <html lang="fr">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
      <title>Ajout film</title>
  </head>
  <body>
  <h1 class="mt-4">Ajout film</h1>

<ul class="nav nav-tabs">
    <li><a class="nav-link" href="exercice3_etape3.php">liste des films</a></li>
    <li><a class="nav-link active" href="ajout_produit.php">Ajout d'un produit</a></li>
</ul>


<?php
echo $contenu;
?>

<!-- 3- formulaire d'ajout de film -->

<form method="post" action="" enctype="multipart/form-data">
<input type="hidden" id="id_produit" name="id_produit" value="0">

<label for="title">Title</label><br>
<input type="text" id="title" name="title" value=""><br><br>

<label for="actors">Actors</label><br>
<input type="text" id="actors" name="actors" value=""><br><br>

<label for="director">Director</label><br>
<input type="text" id="director" name="director" value=""><br><br>

<label for="producer">Producer</label><br>
<textarea name="producer" id="producer"></textarea><br><br>

<label for="year_of_prod">Year of prod</label><br>
<select name="language" id="language">
<option value="francais">1990</option>
<option value="anglais">1980</option>
<option value="espagnol">1970</option>
<option value="allemand">1960</option>
</select><br><br>

<label for="language">Language</label><br>
<select name="language" id="language">
<option value="francais">Francais</option>
<option value="anglais">Anglais</option>
<option value="espagnol">Espagnol</option>
<option value="allemand">Allemand</option>
</select><br><br>

<label for="category">Category</label><br>
<select name="category" id="category">
<option value="horreur">Horreur</option>
<option value="action">Action</option>
<option value="dramatique">Dramatique</option>
<option value="comique">Comique</option>
</select><br><br>

<label for="storyline">Storyline</label><br>
<input type="text" id="storyline" name="storyline" value=""><br><br>

<label for="video">video</label><br>
<input type="url" id="video" name="video" value="0"><br><br>

<input type="submit" value="valider" class="btn">


</form>

  </body>
  </html>