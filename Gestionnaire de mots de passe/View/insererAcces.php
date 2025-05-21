<form method="post">
        <fieldset>
            <legend>Formulaire d'insertion d'accès</legend>
            <label for="site">Site web</label></br>
                <input type="text" name="site" id="site" placeholder="ex : youtube"></br>
            <label for="lien">Lien associé</label></br>
                <input type="url" name="lien" id="lien" placeholder="ex : youtube.com"></br>
            <label for="login">Identifiant site web</label></br>
                <input type="text" name="login" id="login" placeholder="ex : daponT"></br>
            <label for="mdp">Mot de passe</label></br>
            <label>
                <input type="password" name="mdp" id="mdp" class="mdp-field">
                <div class="password-icon">
                    <i data-feather="eye" id="eye-icon"></i>
                    <i data-feather="eye-off" id="eye-off-icon" style="display: none;"></i>
                </div> 
            </label>
                <button type="button" id="generatePasswordBtn">Générer mot de passe</button>
            </label></br>
                
            <input type="submit" name="ajouter" id='ajouter' value='Ajouter' class="button"></br>
            
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

<?php

if (isset($_POST['ajouter'])) {
    if (empty($_POST['site']) || empty($_POST['lien']) || empty($_POST['login']) || empty($_POST['mdp'])) {
        $dateLog = date('d.m.Y H:i:s');
        $log = "Ajout d'accès mdp échoué  |  date:  ".$dateLog."  |  user:  ".$_SESSION['login']."  |  cause:  ".$type[2]."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";

        echo "<script>alert('Veuillez remplir tous les champs');</script>";

        error_log($log, 3, "log.txt");
    } else {
        $mdpManager = new MdpManager();

        if ($mdpManager -> testerMdp($_POST['mdp']) >= 3){
            $dateLog = date('d.m.Y H:i:s');
            $log = "Ajout d'accès mdp réussit  |  date:  ".$dateLog."  |  user:  ".$_SESSION['login']."  |  site:  ".$_POST['site']."  |  lien:  ".$_POST['lien']."  |  identifiant:  ".$_POST['login']."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";

            $acces = new AccesManager();
            $mdpManager -> chiffrerAsy($_POST['mdp']);
            $mdpChiffrerAsy = $mdpManager -> chiffrerAsy($_POST['mdp']);;

            $accesAjout = $acces -> ajouterAcces($_SESSION['login'], $_POST['site'], $_POST['lien'], $_POST['login'], $mdpChiffrerAsy);

            echo "<script>alert('Accès ajouté avec succès');</script>";
            
            error_log($log, 3, "log.txt");
        } else {
            $dateLog = date('d.m.Y H:i:s');
            $mdpTest = $mdpManager -> testerMdp($_POST['mdp']);
            
            echo "<script>alert('Mot de passe trop faible ".$mdpTest."/4. Veuillez choisir un mot de passe plus robuste');</script>";

            $log = "Ajout d'accès mdp échoué  |  date:  ".$dateLog."  |  user:  ".$_SESSION['login']."  |  cause:  ".$type[4]."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";

            error_log($log, 3, "log.txt");
        }
    }
}

?>