<?php
include_once('index.php');
class Connexion {
protected $pdo, $serveur, $utilisateur, $motDePasse, $dataBase;

public function __construct($s,$u,$m,$d)
{
    $this->serveur = $s;
    $this->utilisateur = $u;
    $this->motDePasse = $m;
    $this->dataBase = $d;

    $this->connexionBDD();
}

protected function connexionBDD()
{
    $this->pdo = new PDO('mysql:host='.$this->serveur.';dbname='.$this->dataBase, $this->utilisateur,$this->motDePasse);
}
public function __sleep()
{
    return array('serveur','utilisateur','motDePasse','dataBase');
}
public function __wakeup()
{
    $this->connexionBDD();
}
   
}