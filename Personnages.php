<?php
// Objet personnage avec ces caractèristiques(force,vie etc..), et ces Getters and Setters
class Personnages {
    // Declaration des variables
    private $_id;
    private $_nom;
    private $_niveau;
    private $_experiences;
    private $_forcePersonnage;
    private $_vitalitePersonnage;
    private $_degats;

    // Déclarations des constantes
    const CEST_MOI = 1; // Constante renvoyée par la methode frapper, si on ce frappe soi meme
    const MORT_PERSONNAGE = 2; // Constante renvoyée par la methode frapper si on a tué le personnage en le frappant
    const COUP_PERSONNAGE = 3; // Constante renvoyée par la metgode frapper si on a bien frapper le personnage

    //Constructeur
    public function __construct(array $donnees) {
        foreach ($donnees as $key => $value)
        {
            $mutateur = 'set' .ucfirst($key);
            if (method_exists($this, $mutateur))
            {
                $this-> $mutateur($value);
            }
        }
    } // EOF __construct

    public function frapper(Personnages $personnages) {
        if($personnages->getId() == $this->_id) {
            return self:: CEST_MOI;
        } 
        // On indique au personnage qu'il doit recevoir des dégats
        // En fonction des dégats reçu on retourne la valeur renvoyée par
        // la methode : self::MORT_PERSONNAGE ou self::COUP_PERSONNAGE
        $personnages->setVitalitePersonnage($personnages->getVitalitePersonnage() - $this->getForcePersonnage());
        print($personnages->getVitalitePersonnage());   
        if($personnages->getVitalitePersonnage() <= 0) {
            $this->getId->delete;
            return self::MORT_PERSONNAGE;
        }
        return self::COUP_PERSONNAGE;     
    } // EOF frapper

    
    public function Degats() {
        $this->_degats += 5;
        // SI on subit 100 degats ou plus le personnage meurt
        if(self::getVitalitePersonnage() < 0) {
            return self::MORT_PERSONNAGE;
        }
        // Sinon, le personnage a bien était frapper et a recu le nombre de dégats indiqué
        return self::COUP_PERSONNAGE;
    } // EOF getDegats

    // Fonction qui vérifie si le nom est valide
    public function nomValide() {
        return !empty($this->_nom);

    }

    // On type la fonction en array car on lui passe un tableau de données
    public function hydrate(array $donnees) {
        foreach($donnees as $key => $values) {
            // On récupere le setters correspondant a l'attribut qu'on a besoin
            $methode = 'set'.ucfirst($key);

            // Si le setters correspondant existe
            if(method_exists($this,$methode)) {
                // On appel le setters
                $this->$methode($values);
            } // EOF if hydrate
        } // EOF foreach hydrate
    } // EOF hydrate

    // Listes des Getters
    public function getId() { return $this->_id; } // EOF id
    public function getNom() { return $this->_nom; } // EOF nom
    public function getNiveau() { return $this->_niveau; } // EOF niveau
    public function getExperiences() { return $this->_experiences; } // EOF experiences
    public function getForcePersonnage() { return $this->_forcePersonnage; } // EOF forcePersonnage
    public function getVitalitePersonnage() { return $this->_vitalitePersonnage; } // EOF vitalitePersonnage
    //public function degats() { return $this->_degats; } // EOF degats

    // Listes des Setters
    public function setId($id) {
        // On force l'id du personnage en int
        $id = (int) $id;

        if($id > 0) {
            $this->_id = $id;
        }
        return $id;

    } // EOF setId

    public function setNom($nom) {
        // On vérifie que le nom du personnage et bien un "string" et on le limite à 30 Caractères max
        if(is_string($nom) && strlen($nom) <= 30) {
            $this->_nom = $nom;

        }
        return $this;
    } // EOF setNom

    public function setNiveau($niveau) {
        // On force le niveau en int
        $niveau = (int) $niveau;
        // On vérifie que le niveau du personnage se situe entre 1 et 50
        if($niveau >= 1 && $niveau <= 50) {
            $this->_niveau = $niveau;
        }
    } // EOF setNiveau

    public function setExperiences($experiences) {
        // On force l'experience en int
        $experiences = (int) $experiences;

        // On verifie que l'experience est comprise entre 0 et 100
        if($experiences >=0 && $experiences <= 100) {
            $this->_experiences = $experiences;
        }
        
    } // EOF setExperiences

    public function setForcePersonnage($forcePersonnage) {
        // On force cette caracteristique en int
        $forcePersonnage = (int) $forcePersonnage;

        // On vérifie que la force du personnage est comprise entre 1 et 100
        if($forcePersonnage >=1 && $forcePersonnage <= 100) {
            $this->_forcePersonnage = $forcePersonnage;
        }
        return $this;
    } // setForcePersonnage

    public function setVitalitePersonnage($vitalitePersonnage) {
        // On force cette caracteristique en int
        $this->_vitalitePersonnage = (int) $vitalitePersonnage;

        // On vérifie que la vitalité du personnage est comprise entre 1 et 100
 //       if($vitalitePersonnage >= 1 && $vitalitePersonnage <= 100) {
//            $this->_vitalitePersonnage = $vitalitePersonnage;
        return $this;
        //}
    } // EOF setVitalitePersonnage

    public function setDegats($degats) {
        // On force les degats en int
        $degats = (int) $degats;
        if($degats >= 0 && $degats >= 100) {
            $this->_degats = $degats;
        }
        
        return $this;
    } // EOF setDegats

} // EOF Personnages
?>