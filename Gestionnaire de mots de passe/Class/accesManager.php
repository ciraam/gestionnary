<?php

Class Acces {
    private $id;
    private $utilisateur;
    private $site;
    private $login;
    private $mdp;

    function __construct($id, $utilisateur, $site, $login, $mdp) {
        $this->id = $id;
        $this->utilisateur = $utilisateur;
        $this->site = $site;
        $this->login = $login;
        $this->mdp = $mdp;
    }

    function getId() {
        return $this->id;
    }
    function getUtilisateur() {
        return $this->utilisateur;
    }
    function getSite() {
        return $this->site;
    }
    function getLogin() {
        return $this->login;
    }
    function getMdp() {
        return $this->mdp;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setUtilisateur($utilisateur) {
        $this->utilisateur = $utilisateur;
    }
    function setSite($site) {
        $this->site = $site;
    }
    function setLogin($login) {
        $this->login = $login;
    }
    function setMdp($mdp) {
        $this->mdp = $mdp;
    }
}

Class AccesManager {
    private $bd;

    function __construct() {
        $this-> bd = new PDO("mysql:host=localhost;dbname=gestionnaire_mdp", 'root', '');
    }

    function ajouterAcces($utilisateur, $site, $lien, $login, $mdp) {
        $sql = "INSERT INTO mdp (utilisateur, site, lien, identifiant, mdp) VALUES (:utilisateur, :site, :lien, :login, :mdp)";
        $requete = $this -> bd -> prepare($sql);
        $requete -> bindParam(':utilisateur', $utilisateur);
        $requete -> bindParam(':site', $site);
        $requete -> bindParam(':lien', $lien);
        $requete -> bindParam(':login', $login);
        $requete -> bindParam(':mdp', $mdp);
        $donnees = $requete -> execute();

        $time = new DateTime();
        $now = $time -> format('d/m/Y H:i:s');
        $sql2 = "INSERT INTO historique (mdp_id, utilisateur_histo, modification) VALUES (".$donnees['id'].", :utilisateur, NOW())";
        $requete2 = $this -> bd -> prepare($sql2);
        $requete2 -> bindParam(':utilisateur', $utilisateur);
        $requete2 -> execute();
        
        return $donnees;
    }

    function supprimerAcces($utilisateur, $id) {
        $sql = "DELETE FROM mdp WHERE utilisateur = :utilisateur AND id = :id";
        $requete = $this -> bd -> prepare($sql);
        $requete -> bindParam(':utilisateur', $utilisateur);
        $requete -> bindParam(':id', $id);
        $donnees = $requete -> execute();
        return $donnees;
    }

    function modifierAcces($utilisateur, $id, $site, $lien, $identifiant, $mdp) {
        $sql = "UPDATE mdp SET site = :site, lien = :lien, identifiant = :identifiant, mdp = :mdp WHERE utilisateur = :utilisateur AND id = :id";
        $requete = $this -> bd -> prepare($sql);
        $donnees = $requete -> execute([
            ':site' => $site,
            ':lien' => $lien,
            ':identifiant' => $identifiant,
            ':mdp' => $mdp,
            ':utilisateur' => $utilisateur,
            ':id' => $id
        ]);
        

        $time = new DateTime();
        $now = $time -> format('d/m/Y H:i:s');
        $sql2 = "INSERT INTO historique (mdp_id, utilisateur_histo, modification) VALUES (:id, :utilisateur, NOW())";
        $requete2 = $this -> bd -> prepare($sql2);
        $requete2 -> execute([
            ':utilisateur' => $utilisateur,
            ':id' => $id
        ]);

        return $donnees;
    }

    function getAcces($utilisateur) {
        $sql = "SELECT * FROM mdp WHERE utilisateur = :utilisateur";
        $requete = $this -> bd -> prepare($sql);
        $requete -> bindParam(':utilisateur', $utilisateur);
        $requete -> execute();
        $donnees = $requete -> fetchAll();
        return $donnees;
    }
    

    function getAccesFiltre($utilisateur, $filtre, $ordre, $nbr) {
        if ($filtre == 3){
            $sql = "SELECT * FROM mdp WHERE utilisateur = :utilisateur ORDER BY site ".$ordre." LIMIT ".$nbr."";
            $requete = $this -> bd -> prepare($sql);
            $requete -> bindParam(':utilisateur', $utilisateur);
            $donnees = $requete -> execute();
            $donnees = $requete -> fetchAll();
            return $donnees;
        } else if ($filtre == 2) {
            $sql = "SELECT * FROM mdp WHERE utilisateur = :utilisateur ORDER BY identifiant ".$ordre." LIMIT ".$nbr."";
            $requete = $this -> bd -> prepare($sql);
            $requete -> bindParam(':utilisateur', $utilisateur);
            $donnees = $requete -> execute();
            $donnees = $requete -> fetchAll();
            return $donnees;
        } else {
            $sql = "SELECT * FROM mdp WHERE utilisateur = :utilisateur ORDER BY id ".$ordre." LIMIT ".$nbr."";
            $requete = $this -> bd -> prepare($sql);
            $requete -> bindParam(':utilisateur', $utilisateur);
            $donnees = $requete -> execute();
            $donnees = $requete -> fetchAll();
            return $donnees;
        }
    }

    function getAccesById($utilisateur, $id) {
        $sql = "SELECT * FROM mdp WHERE utilisateur = :utilisateur AND id = :id";
        $requete = $this -> bd -> prepare($sql);
        $requete -> execute([':utilisateur' => $utilisateur, ':id' => $id]);
        $donnees = $requete -> fetch();
        return $donnees;
    }

    function getHistoAccesById($utilisateur, $id) {
        $sql = "SELECT * FROM historique WHERE utilisateur_histo = :utilisateur AND mdp_id = :id";
        $requete = $this -> bd -> prepare($sql);
        $requete -> execute([':utilisateur' => $utilisateur, ':id' => $id]);
        $donnees = $requete -> fetchAll();
        return $donnees;
    }

    // à améliorer
    function rechercherAcces($utilisateur, $id, $recherche, $filtre) {
        $sql = "SELECT * FROM mdp WHERE site LIKE '%:recherche%' OR identifiant LIKE '%:recherche%' OR mdp LIKE '%:recherche%'";
        $requete = $this -> bd -> prepare($sql);
        $requete -> bindParam(':utilisateur', $utilisateur);
        $requete -> bindParam(':id', $id);
        $requete -> bindParam(':recherche', $recherche);
        $donnees = $requete -> execute();
        $donnees = $requete -> fetchAll();
        return $donnees;
    }

}

?>