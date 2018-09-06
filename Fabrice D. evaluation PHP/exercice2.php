<?php 
$euro = 1;
$dollar = 1.085965;

function conversion() {

    if(isset$_POST['convert']) {
 
        $valeur = $_POST['valeur'];
     
        $resultat = $_POST['valeur']*0.865;
     
        echo $resultat;
    }
}







?>