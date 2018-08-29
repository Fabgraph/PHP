<?php

/*Sujet :
Vous créez un tableau PHP contenant les pays suivants :
- France
- Italie
- Espagne
- Inconnu
- Allemagne

Vous leur associez les valeurs suivantes :
- Paris
- Rome
- Madrid
- '?'
- Berlin

Vous parcourez ce tableau pour afficher la phrase "La capitale X si situe en Y" dans un <p>, où X remplace la capitale et Y le pays.

Pour le pays "inconnu", vous affichez "La capitale de inconnu n'existe pas !" à la place de la phrase précédente.
*/ 
$tableau =array(
                'France' => 'Paris',
                'Italie'    => 'Rome',
                'Espagne'    => 'Madrid',
                'Inconnu'    => '?',
                'Allemagne'    => 'Berlin',    
                );

// print_r($tableau);
foreach ($tableau as $pays => $capitales) {
    if ($pays == 'Inconnu') {
        echo '<p>La capitale de '. $pays .' n\'existe pas !</p>';
    } else {
        echo '<p>La capitale ' . $capitales .' si situe en '. $pays .'.</p>' ;
    }
}
