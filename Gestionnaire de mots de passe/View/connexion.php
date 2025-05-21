<form method="post">
        <fieldset>
            <legend>Veuillez vous connecter</legend>
            <label for="login">Identifiant</label></br>
            <input type="text" name="login" id="login" placeholder="ex : daponT"></br>
            <label for="mdp">Mot de passe "Maître"</label></br>
            <label>
                <input type="password" name="mdp" id="mdp">
                <div class="password-icon">
                    <i data-feather="eye"></i>
                    <i data-feather="eye-off"></i>
                </div>
            </label></br>
            
            <input type="submit" name="rechercher" id='rechercher' value='Connexion' class="button"></br>
        </fieldset>
</form>
<a href="?action=inscription">Pas de compte ?</a>
<a href="?action=reinitialiserMdp">Mot de passe oublié ?</a>

<?php

echo "<br> à supprimer quand fini => login : test2 / mdp : TEst02*";

if(isset($_POST['login']) && isset($_POST['mdp'])){
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    $dateLog = date('d.m.Y H:i:s');
    $utilisateurManager = new UtilisateurManager();
    $mdpManager = new MdpManager();
    $mdpHash = $mdpManager -> hasherMdp($mdp);
    $connexion = $utilisateurManager -> connecter($login, $mdpHash);

    if (empty($login) || empty($mdp)){
    } else {
        if ($connexion == true ){
            $utilisateurManager -> getUtilisateursByMdp($login, $mdpHash);
            $_SESSION['id'] = $utilisateurManager -> getUtilisateursByMdp($login, $mdpHash)['id'];
            $_SESSION['nom'] = $utilisateurManager -> getUtilisateursByMdp($login, $mdpHash)['nom'];
            $_SESSION['prenom'] = $utilisateurManager -> getUtilisateursByMdp($login, $mdpHash)['prenom'];
            $_SESSION['login'] = $login;
            
            header("Location: ?action=accueil");

            $log = "Connexion réussite  |  date:  ".$dateLog."  |  user:  ".$_POST['login']."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";

            error_log($log, 3, "log.txt");
        } else {
            echo "<script>alert('Échec de la connexion');</script>";

            $log = "Connexion échouée  |  date:  ".$dateLog."  |  cause:  ".$type[6]."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";

            error_log($log, 3, "log.txt");
        }   
    }
}
?>