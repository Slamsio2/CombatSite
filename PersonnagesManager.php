<?php
// Class qui gère la création des personnages et les insère en BDD avec la methode CRUD
class PersonnagesManager
{
    // Déclarations des variables
    private $_db;

    // Constructeur
    public function __construct($db)
    {
        $this->setDb($db);
    } // EOF __construct

    // Requête create en BDD
    public function add(Personnages $personnages)
    {
        // Préparation de la requête d'insertion
        $request = $this->_db->prepare('INSERT INTO personnages(nom, niveau, experiences, forcePersonnage, vitalitePersonnage, degats)
                                    VALUES(:nom, :niveau, :experiences, :forcePersonnage, :vitalitePersonnage, :degats)');

        // Assignation des valeurs pour le nom, le niveau, l'experiences acquise, la force du perso, la vialité du perso
        $request->bindValue(':nom', $personnages->getNom());
        $request->bindValue(':niveau', $personnages->getNiveau(), PDO::PARAM_INT);
        $request->bindValue(':experiences', $personnages->getExperiences(), PDO::PARAM_INT);
        $request->bindValue(':forcePersonnage', $personnages->getForcePersonnage(), PDO::PARAM_INT);
        $request->bindValue(':vitalitePersonnage', $personnages->getVitalitePersonnage(), PDO::PARAM_INT);
        $request->bindValue(':degats', $personnages->degats(), PDO::PARAM_INT);

        // On execute la requête
        $request->execute();


        // On hydrate(initalise) les valeurs du personnages
        $personnages->hydrate([
            'id' => $this->_db->lastInsertId(),
            'niveau' => ':niveau',
            'experiences' => ':experiences',
            'forcePersonnage' => ':forcePersonnage',
            'vitalitePersonnage' => ':vitalitePersonnage',

        ]); // EOF hydrate
    } // EOF add

    // Fonction qui vérifie le nombre de personnage en bdd
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM personnages')->fetchColumn();
    } // EOF count

    // Requête delete en BDD
    public function delete(Personnages $personnages)
    {
        //Execution d'une requête delete
        $this->_db->execute('DELETE FROM personnages WHERE id = ' . $personnages->getId());
    } // EOF delete

    public function exists($infos)
    {
        // On vérifie si un personnages ayant pour id $infos existe
        if (is_int($infos)) {
            return (bool) $this->_db->query('SELECT COUNT(*) FROM personnages WHERE id=' . $infos)->fetchColumn();
        }
        // Sinon on vérifie que le nom existe ou pas
        $existe = $this->_db->prepare('SELECT COUNT(*) FROM personnages WHERE nom = :nom');
        $existe->execute([':nom' => $infos]);

        return (bool) $existe->fetchColumn();
    } // EOF personnagesExists

    // Requête select en BDD
    public function getOne($infos)
    {
        if (is_int($infos)) {
            // Execution d'une requête SELECT avec une clause WHERE, qui retourne l'obj personnages
            $select = $this->_db->query('SELECT id, nom, niveau, experiences, forcePersonnage, vitalitePersonnage 
                                         FROM personnages 
                                         WHERE id =' . $infos);

            $donnees = $select->fetch(PDO::FETCH_ASSOC);

            return new Personnages($donnees);
        } // EOF if getBDD
        else {
            $select = $this->_db->prepare('SELECT id, nom, niveau, experiences, forcePersonnage, vitalitePersonnage 
                                           FROM personnages 
                                           WHERE nom = :nom');
            $select->execute([':nom' => $infos]);

            return new Personnages($select->fetch(PDO::FETCH_ASSOC));
        } // EOF else getBDD
    } // EOF getBdd

    // Requête read en BDD
    public function getList($nom)
    {
        $personnages = [];

        $request = $this->_db->prepare('SELECT id, nom, niveau, experiences, forcePersonnage, vitalitePersonnage, degats 
                                       FROM personnages 
                                       WHERE nom <> :nom
                                       ORDER BY nom, niveau');
        $request->bindValue(':nom', $nom, PDO::PARAM_STR);

        // On execute la requête
        $request->execute();

        while ($donnees = $request->fetch(PDO::FETCH_ASSOC)) {
            $personnages[] = new Personnages($donnees);
        } // EOF While
        return $personnages;
    } // EOF getList

    // Requête UPDATE
    public function update($personnages)
    {
        // Préparation de la requête de type Update
        $request = $this->_db->prepare('UPDATE personnages 
                                    SET niveau = :niveau, experiences = :experiences, forcePersonnage = :forcePersonnage, vitalitePersonnage = :vitalitePersonnage, degats = :degats
                                    WHERE id = :id');

        //Assignation des valeurs à la requête
        $request->bindValue('id', $personnages->getId());
        $request->bindValue('niveau', $personnages->getNiveau(), PDO::PARAM_INT);
        $request->bindValue('experiences', $personnages->getExperiences(), PDO::PARAM_INT);
        $request->bindValue('forcePersonnage', $personnages->getForcePersonnage(), PDO::PARAM_INT);
        $request->bindValue('vitalitePersonnage', $personnages->getVitalitePersonnage(), PDO::PARAM_INT);
        $request->bindValue('degats', $personnages->degats(), PDO::PARAM_INT);

        // Execution de la requête
        $request->execute();
    } // EOF update

    // connexion a la bdd
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
} // EOF PersonnagesManager
