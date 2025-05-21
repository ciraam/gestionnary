<form method="post">
        <fieldset>
            <legend>Formulaire de création de profil</legend>
            <label for="nom">Nom</label></br>
            <input type="text" name="nom" id="nom" placeholder="ex : David"></br>
            <label for="prenom">Prénom</label></br>
            <input type="text" name="prenom" id="prenom" placeholder="ex : Dupont"></br>
            <label for="mail">Adresse mail</label></br>
            <input type="email" name="mail" id="mail" placeholder="ex : dupont.david@example.com"></br>
            <label for="login">Identifiant</label></br>
            <input type="text" name="login" id="login" placeholder="ex : daponT" minlength="6" maxlength="20"></br>
            <label for="mdp">Mot de passe "Maître"</label></br>
            <label>
                <input type="password" name="mdp" id="mdp" class="mdp-field">
                <div class="password-icon">
                    <i class="feather-eye" data-feather="eye"></i>
                    <i class="feather-eye-off" style="display: none;" data-feather="eye-off"></i>
                </div>
                </label>
                <button type="button" id="generatePasswordBtn">Générer mot de passe</button>
            
            </label></br>
            <label for="mdpConfirme">Veuillez confirmer votre mot de passe "Maître"</label></br>
                <input type="password" name="mdpConfirme" id="mdpConfirme" minlength="6"></br>
            
            <input type="submit" name="rechercher" id='rechercher' value='Créer' class="button"></br>

            <p id="robustesse">Robustesse du mot de passe :</p>
            <div id="barreRobustesse">
                <div id="progression"></div>
            </div>
            <p>Pour être robuste votre mot de passe, doit être compris entre 6 et 20 caractères sans espace et doit contenir : (au moins 3 critères sur 4)</p>
            <ul>
                <li>2 majuscules</li>
                <li>2 minuscules</li>
                <li>2 chiffres</li>
                <li>1 caractère spécial</li>
            </ul>
        </fieldset>           
</form>
<a href="?action=connexion">Revenir à la page de connexion</a>

<?php

if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['login']) && isset($_POST['mdp']) && isset($_POST['mdpConfirme'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $login = $_POST['login'];
    $mdpMaitre = $_POST['mdp'];
    $mdpConfirme = $_POST['mdpConfirme'];
    $dateLog = date('d.m.Y H:i:s');
    $utilisateurManager = new UtilisateurManager();
    $mdpManager = new MdpManager();

    if (empty($nom) || empty($prenom) || empty($mail) || empty($login) || empty($mdpMaitre) || empty($mdpConfirme)){
        $log = "Inscription échouée  |  date:  ".$dateLog."  |  cause:  ".$type[2]."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";

        echo "<script>alert('Veuillez remplir tous les champs');</script>";
        error_log($log, 3, "log.txt");
    } else {
        if ($mdpMaitre === $mdpConfirme) {
            if ($mdpManager -> testerMdp($mdpMaitre) >= 3){
                $mdpMaitreHash = $mdpManager -> hasherMdp($mdpMaitre);
                $utilisateurLogin = $utilisateurManager -> getUtilisateurs($_POST['login']);
                $utilisateurMail = $utilisateurManager -> verifierMail($_POST['mail']);

                if ($utilisateurLogin == false) {
                    if ($utilisateurMail == false) {
                        $utilisateurManager -> creerCompte($nom, $prenom, $mail, $login, $mdpMaitreHash);
                        echo "Votre profil a bien été enregistré";
                        echo "</br> <a href='?action=connexion'>Se connecter</a>";

                        $log = "Inscription réussite  |  date:  ".$dateLog."  |  nom:  ".$nom."  |  prénom:  ".$prenom."  |  mail:  ".$mail."  |  identifiant:  ".$login."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";
                        
                        error_log($log, 3, "log.txt");
                    } else {
                        echo "<script>alert('Adresse mail déjà enregistrée');</script>";

                        $log = "Inscription échouée  |  date:  ".$dateLog."  |  cause:  ".$type[9]."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";

                        error_log($log, 3, "log.txt");
                    }
                } else {
                    echo "<script>alert('Identifiant déjà enregistré');</script>";

                    $log = "Inscription échouée  |  date:  ".$dateLog."  |  cause:  ".$type[10]."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";

                    error_log($log, 3, "log.txt");
                }
            } else {
                $mdpTest = $mdpManager -> testerMdp($mdpMaitre);
                echo "<script>alert('Mot de passe trop faible ".$mdpTest."/4. Veuillez choisir un mot de passe plus robuste');</script>";

                $log = "Inscription échouée  |  date:  ".$dateLog."  |  cause:  ".$type[4]."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";

                error_log($log, 3, "log.txt");
            }          
        } else {
            echo "<script>alert('Confirmation du mot de passe différente');</script>";

            $log = "Inscription échouée  |  date:  ".$dateLog."  |  cause:  ".$type[5]."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";

            error_log($log, 3, "log.txt");
        }
    }
}

?>