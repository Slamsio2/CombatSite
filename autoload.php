<?php 
    // fonction Autoload des différentes class grace a spl_autoload_register
    function autoLoader($classe) {
        // On inclut la classe corréspondante au paramètre passé
        require $classe . '.php';
    }
    // On enregistre cette fonction dans la pile de chargement de l'appli
    spl_autoload_register('autoLoader');

    // Connexion a la BDD
$db = new PDO('mysql:host=localhost;dbname=rpgphp', 'root', '');
// Gestions des erreurs
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>