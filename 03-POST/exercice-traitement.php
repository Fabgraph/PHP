<?php
$rempli = '';

// var_dump($_POST);

if (!empty($_POST)) {

    $rempli = '<p>Ville : ' . $_POST['ville'] . '</p>';
    $rempli .= '<p>Code postal : ' . $_POST['code_postal'] . '</p>';
    $rempli .= '<p>Adresse : ' . $_POST['adresse'] . '</p>';
}

echo $rempli;
?>

