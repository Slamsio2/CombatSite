<?php 
    // fonction Autoload des différentes class grace a spl_autoload_register
    function autoLoader($classe) {
        // On inclut la classe corréspondante au paramètre passé
        require $classe . '.php';
    }
    // On enregistre cette fonction dans la pile de chargement de l'appli
    spl_autoload_register('autoLoader');

    // Connexion a la BDD
    $options = array(
        PDO::MYSQL_ATTR_SSL_CA => "C:\\php\\cacert-2022-07-19.pem",
      );
        $db = new PDO('mysql:host=aws-eu-west-2.connect.psdb.cloud;dbname=dec', 'lrh1xr5qxma04ytnqv7u', 'pscale_pw_fwyhvzrZ36styU22mrWorRvQTAcv2VadB4XwCTeK86v', $options);      
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Gestions des erreurs

?>