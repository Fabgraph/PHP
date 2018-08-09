<?php
// Exercice : 
/*
- Créer un formulaire avec les champs ville et code postal, et une zone de texte adresse.
- Vous envoyez les données saisies par l'internaute dans exercice-traitement.php. 
  Vous y affichez ces saisies en précisant l'étiquette correspondante.
*/

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire</title>
</head>
<body>
    <h1>Formulaire</h1>
    <form method="post" action="exercice-traitement.php">
        <div>
            <label for="ville">Ville</label>
            <input type="text" name="ville" id="ville" value="">
        </div>
        <div>
            <label for="code_postal">Code postal</label>
            <input type="text" name="code_postal" id="code_postal" value="">
        </div>
        <div>
            <label for="adresse">Adresse</label>
            <textarea name="adresse" id="adresse" cols="20" rows="1"></textarea>
        </div>
        <div>
            <input type="submit" name="validation" value="envoyer">
        </div>
    
    </form>






    
</body>
</html>