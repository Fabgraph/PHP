<?php

/* Sujet :
    - Créer une fonction qui permet de convertir une date FR en date US, ou inversement. Cette fonction prend 2 paramètres : une date et le format de conversion "US" ou "FR".
    - Vous validez que le paramètre format de sortie est bien "US" ou "FR". La fonction retourne un message si ce n'est pas le cas.
*/

// Préambule à l'exercie :

$aujourdhui = date('d-m-Y'); // donne la date du jour au format indiqué
echo $aujourdhui . '<br>';

//-----------
// Convertir une date d'un format vers un autre :
$date = '2018-08-24';
echo 'La date au format US : '. $date .'<br>';

$objetDate = new DateTime($date);
echo 'La date au format FR : '. $objetDate->format('d-m-Y'); // la méthode format() permet de convertir un objet date selon le format indiqué

echo '<hr>';

// Votre exercice : 

function conversionDeDate($date, $format) {
    // vérifier la valeur du paramètre $format :
        if ($format != 'US' && $format != 'FR') {
            return 'Erreur sur le format !';
        }
    // une fois le(s) paramètre(s) validés, on fait le traitement :
	if ($format == 'FR') {
		$objetDate = new DateTime($date);
        return 'La date au format FR : '. $objetDate->format('d-m-Y');
	} else {
        $objetDate = new DateTime($date);
        return 'La date au format US : '. $objetDate->format('Y-m-d');
    }
}

echo conversionDeDate('25-12-2009', 'US');
echo '<br>';
echo conversionDeDate('2018-08-01', 'FR');
echo '<br>';
echo conversionDeDate('12-2020-25', 'XX');