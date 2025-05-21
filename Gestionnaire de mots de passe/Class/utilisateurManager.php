<?php

Class Utilisateur {
    private $id;
    private $nom;
    private $prenom;
    private $login;
    private $mdpMaitre;
    private $mdp;

    function __construct($id, $nom, $prenom, $login, $mdpMaitre, $mdp) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->login = $login;
        $this->mdpMaitre = $mdpMaitre;
        $this->mdp = $mdp;
    }

    function getId() {
        return $this->id;
    }
    function getNom() {
        return $this->nom;
    }
    function getPrenom() {
        return $this->prenom;
    }
    function getLogin() {
        return $this->login;
    }
    function getMdpMaitre() {
        return $this->mdpMaitre;
    }
    function getMdp() {
        return $this->mdp;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setNom($nom) {
        $this->nom = $nom;
    }
    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }
    function setLogin($login) {
        $this->login = $login;
    }
    function setMdpMaitre($mdpMaitre) {
        $this->mdpMaitre = $mdpMaitre;
    }
    function setMdp($mdp) {
        $this->mdp = $mdp;
    }
}

Class UtilisateurManager {
    private $bd;

    function __construct() {
        $this-> bd = new PDO("mysql:host=localhost;dbname=gestionnaire_mdp", 'root', '');
    }

    function getUtilisateurs($login) {
        $sql = "SELECT * FROM utilisateur WHERE login = :login";
        $requete = $this -> bd -> prepare($sql);
        $requete -> bindParam(':login', $login);
        $donnees = $requete -> execute();
        $donnees = $requete -> fetch();
        return $donnees;
    }

    function getUtilisateursByMdp($login, $mdpMaitre) {
        $sql = "SELECT * FROM utilisateur WHERE login = :login AND mdpMaitre = :mdpMaitre";
        $requete = $this -> bd -> prepare($sql);
        $requete -> bindParam(':login', $login);
        $requete -> bindParam(':mdpMaitre', $mdpMaitre);
        $donnees = $requete -> execute();
        $donnees = $requete -> fetch();
        return $donnees;
    }

    function getUtilisateursByMail($login, $mail) {
        $sql = "SELECT * FROM utilisateur WHERE login = :login AND mail = :mail";
        $requete = $this -> bd -> prepare($sql);
        $requete -> bindParam(':login', $login);
        $requete -> bindParam(':mail', $mail);
        $donnees = $requete -> execute();
        $donnees = $requete -> fetch();
        return $donnees;
    }
    
    function verifierMail($mail) {
        $sql = "SELECT * FROM utilisateur WHERE mail = :mail";
        $requete = $this -> bd -> prepare($sql);
        $requete -> bindParam(':mail', $mail);
        $donnees = $requete -> execute();
        $donnees = $requete -> fetch();
        return $donnees;
    }

    function creerCompte($nom, $prenom, $mail, $login, $mdpMaitre) {
        $sql = "INSERT INTO utilisateur (nom, prenom, mail,  login, mdpMaitre) VALUES (:nom, :prenom, :mail, :login, :mdpMaitre)";
        $requete = $this -> bd -> prepare($sql);
        $requete -> bindParam(':nom', $nom);
        $requete -> bindParam(':prenom', $prenom);
        $requete -> bindParam(':mail', $mail);
        $requete -> bindParam(':login', $login);
        $requete -> bindParam(':mdpMaitre', $mdpMaitre);
        $donnees = $requete -> execute();
        return $donnees;
    }

    function connecter($login, $mdp) {
        $sql = "SELECT * FROM utilisateur WHERE login = :login AND mdpMaitre = :mdp";
        $requete = $this -> bd -> prepare($sql);
        $requete -> bindParam(':login', $login);
        $requete -> bindParam(':mdp', $mdp);
        $requete -> execute();
        $donnees = $requete -> fetch();
        return $donnees;
    }
        
}

?>