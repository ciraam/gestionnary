<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="afficherMasquerMdp.css">
<link rel="stylesheet" href="robustesseMdp.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">

<?php

session_start();

require_once("Class/mdpManager.php");
require_once("Class/accesManager.php");
require_once("Class/utilisateurManager.php");

$alerte = [1 => "En cours", 2 => "Terminé"];
$test = [1 => "Faible", 2 => "Moyen", 3 => "Fort", 4 => "Robuste"];
$type = [1 => "404", 2 => "Champs vide(s)", 3 => "Erreur SQL", 4 => "Faible mdp", 5 => "Différents mdp", 6 => "Mauvais login et/ou mdp", 7 => "Adresse mail non-enregistrée", 8 => "Identifiant non-enregistré", 9 => "Adresse mail déjà enregistrée", 10 => "Identifiant déjà enregistré", 11 => "Inconnue"];

if (file_exists('log.txt')){
} else {
    fopen('log.txt','c+w');
}
date_default_timezone_set("Europe/Paris");

if(isset($_GET['action'])){
    if ($_GET["action"] == "inscription"){
        $title = "Page d'inscription";
        require_once("View/inscription.php");
    }
    if ($_GET["action"] == "accueil"){
        $title = "Page d'accueil";
        require_once("View/header.php");
        require_once("View/accueil.php");
    }
    if ($_GET["action"] == "connexion"){
        $title = "Page de connexion";
        // require_once("View/header.php");
        require_once("View/connexion.php");
    }
    if ($_GET["action"] == "reinitialiserMdp"){
        $title = "Page de réinitialisation du mot de passe";
        // require_once("View/header.php");
        require_once("View/reinitialiserMdp.php");
    }
    if ($_GET["action"] == "insererAcces"){
        $title = "Page d'insertion d'accès";
        require_once("View/header.php");
        require_once("View/insererAcces.php");
    }
    if ($_GET["action"] == "modifierAcces"){
        $title = "Page de modification d'accès";
        require_once("View/header.php");
        require_once("View/modifierAcces.php");
    }
    if ($_GET["action"] == "supprimerAcces"){
        $title = "Page de supression d'accès";
        require_once("View/header.php");
        require_once("View/supprimerAcces.php");
    }
}
else {
    $title = "Page de connexion";
    require_once("View/connexion.php");  
}

require_once("View/footer.php");

?>