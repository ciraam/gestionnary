<?php

Class Mdp {
    private $id;
    private $utilisateur;
    private $mdp;

    function __construct($id, $utilisateur,$mdp) {
        $this->id = $id;
        $this->utilisateur = $utilisateur;
        $this->mdp = $mdp;
    }

    function getId() {
        return $this->id;
    }
    function getUtilisateur() {
        return $this->utilisateur;
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
    function setMdp($mdp) {
        $this->mdp = $mdp;
    }
}

Class MdpManager {
    private $bd;

    function __construct() {
        $this-> bd = new PDO("mysql:host=localhost;dbname=gestionnaire_mdp", 'root', '');
    }

    function hasherMdp($mdp){
        $mdpHache = hash('sha256', $mdp);
        return $mdpHache;
    }

    // faire des méthodes pour le chiffrement asymétrique afin de pouvoir chiffrer les mdp d'accès

    function testerMdp($mdp){
        $compteur = 0;
        // Expression régulière pour détecter un mot de passe faible
        $regex = '/[A-Z]{2,}/'; // minimum 2 lettres majuscules
        $regex2 = '/[a-z]{2,}/'; // minimum 2 lettres miniscules
        $regex3 = '/[^a-zA-Z0-9]/'; // au moins 1 caractère spécial
        $regex4 = '/[0-9]{2,}/'; // minimum 2 chiffres 
        $regex5 = '/\S{6,20}/'; // sans espace avec minimum 6 caractères et maximum 20 caractères
        // $regex6 = '/\w/'; pas l'air de fonctionner ?

        // Vérifie si le mdp correspond à l'expression régulière
        if (preg_match_all($regex, $mdp)){
            $compteur = $compteur +1; // Le mot de passe est fort
        } 
        if (preg_match_all($regex2, $mdp)){
            $compteur = $compteur +1; // Le mot de passe est fort
        } 
        if (preg_match_all($regex3, $mdp)){
            $compteur = $compteur +1; // Le mot de passe est fort
        } 
        if (preg_match_all($regex4, $mdp)){
            $compteur = $compteur +1; // Le mot de passe est fort
        }
        if (preg_match_all($regex5, $mdp)){
            $compteur = $compteur +1; // Le mot de passe est fort
        }

        return $compteur;
    }

    function genererMdpRobuste($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }
        if ($this -> testerMdp($password) > 3){
            return $password;
        } else {
            $this -> genererMdpRobuste();
        }
    }

    function chiffrerAsy($mdp){
        // $key = ""
        if (isset($mdp)){
            $algo = "AES-128-GCM";
            $cleSecrete = "1234";
            $option = 0;
            $iv = " ";
            $tag = "GCM";
            $message = openssl_encrypt($mdp, "AES-128-ECB", $cleSecrete);
            // , $option, $iv, $tag

            return $message;
        }
    }

    function dechiffrerAsy($mdp){
        if (isset($mdp)){
            $algo = "AES-128-GCM";
            $cleSecrete = "1234";
            $option = 0;
            $iv = " ";
            $tag = "GCM";
            $message = openssl_decrypt($mdp, "AES-128-ECB", $cleSecrete);

            return $message;
        }
    }
        
}

?>