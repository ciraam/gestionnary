<?php
if(isset($_GET['user'])){
    $utilisateur = $_GET['user'];
    $id = $_GET['id'];

    $dateLog = date('d.m.Y H:i:s');
    $log = "Suppression d'accès mdp réussite  |  date:  ".$dateLog."  |  user:  ".$utilisateur."  |  idAccès:  ".$id."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";
    $log2 = "Suppression d'accès mdp échouée  |  date:  ".$dateLog."  |  user:  ".$utilisateur."  |  idAccès:  ".$id."  |  cause:  ".$type[3]."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";

    $acces = new AccesManager();

    if ($acces -> supprimerAcces($utilisateur, $id)) {
        echo "<script>alert('Accès supprimé avec succès'); window.location.href = '?action=accueil';</script>";
        error_log($log, 3, "log.txt");
    } else {
        echo "<script>alert('Erreur lors de la suppression');</script>";
        error_log($log2, 3, "log.txt");
    }

    exit();
}
?>