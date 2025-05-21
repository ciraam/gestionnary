<?php 

// view spécifique contenant 2 méthodes, afin de pouvoir utiliser une requête AJAX pour la génération du mot de passe dans "insererAcces.php"

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
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
    $mdp = '';
    for ($i = 0; $i < $length; $i++) {
        $mdp .= $caracteres[random_int(0, strlen($caracteres) - 1)];
    }
    if (testerMdp($mdp) > 3){
        return $mdp;
    } else {
        return genererMdpRobuste();
    }
}

echo genererMdpRobuste();

?>