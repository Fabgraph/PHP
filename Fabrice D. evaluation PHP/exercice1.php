<?php
// tableau PHP :
$membre = array(
    'Prenom' => 'Jean',
    'Nom' => 'Pierre',
    'Adresse' => '142 avenue Jean Jaures',
    'Code postal' => '93500',
    'Ville' => 'Pantin',
    'Email' => 'j.pierre@mail.com',
    'Telephone' => '0601489728',
    'Date_de_naissance' => '1997-12-25',

);

print_r($membre);


//foreach moyen de passer en revue un tableau :

foreach($membre as $details) {  // le mot clé "as" fait partie de la structure du foreach et est obligatoire. La variable $valeur (que l'on nomme comme on veut) vient parcourir les valeurs du tableau $tab. Quand il y a qu'une seule variable après "as", elle parcourt systématiquement les VALEURS
    echo $details . '<br>';  // on affiche successivement à chaque tour de boucle les éléments du tableau
}


// Convertir une date d'un format vers un autre :
    
    $date_de_naissance = new DateTime($date);
    echo $date_de_naissance->format('d-m-Y'); 
    
    echo '<hr>';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice 1</title>
</head>
<body>

    
    
</body>
</html>