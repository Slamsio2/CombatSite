<?php

include_once('Connexion.php');

session_start();

if(!isset($_SESSION['connexion']))
{
    $connexion = new Connexion('localhost', 'root', '', 'comptes');
    $_SESSION['connexion'] = $connexion;

    echo 'Actualiser la page !';
}

else{
    echo'<pre>';
    var_dump($_SESSION['connexion']); //On affiche les infos concernant notre objet.
    echo '<br/><br/><br/><br/><br/>';
    print_r($_SESSION['connexion']);
    echo'</pre>';
}
?>