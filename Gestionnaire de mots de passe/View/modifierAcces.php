<?php

$id = $_GET['id'];
$utilisateur = $_GET['user'];
$acces = new AccesManager();
$mdp = new MdpManager();
$accesMod = $acces -> getAccesById($utilisateur, $id);
$mdp -> dechiffrerAsy($accesMod['mdp']);
$mdpDechiffrerAsy = $mdp -> dechiffrerAsy($accesMod['mdp']);

?>

<form method="post">
        <fieldset>
        <legend>Formulaire de modification d'accès</legend>
            <label for="site">Site web associé</label></br>
            <input type="text" name="site" id="site" value="<?php echo isset($accesMod['site']) ? htmlspecialchars($accesMod['site']) : ''; ?>"></br>

            <label for="lien">Lien associé</label></br>
            <input type="url" name="lien" id="lien" value="<?php echo isset($accesMod['lien']) ? htmlspecialchars($accesMod['lien']) : ''; ?>"></br>

            <label for="login">Identifiant site web</label></br>
            <input type="text" name="login" id="login" value="<?php echo isset($accesMod['identifiant']) ? htmlspecialchars($accesMod['identifiant']) : ''; ?>"></br>

            <label for="mdp">Mot de passe site web</label></br>
            <label>
            <input type="password" name="mdp" id="mdp" value="<?php echo isset($mdpDechiffrerAsy) ? htmlspecialchars($mdpDechiffrerAsy) : ''; ?>">
                <div class="password-icon">
                    <i data-feather="eye"></i>
                    <i data-feather="eye-off"></i>
                </div>
                </label>
                <button type="button" id="generatePasswordBtn">Générer mot de passe</button>
            </label></br>

            <input type="submit" name="modifier" id='modifier' value='Modifier' class="button"></br>

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

if (isset($_POST['modifier'])) {
    $dateLog = date('d.m.Y H:i:s');
    $accesModif = new AccesManager();
    $mdpManager = new MdpManager();

    if ($mdpManager -> testerMdp($_POST['mdp']) >= 3){
        if ($accesModif -> modifierAcces($utilisateur, $id, $_POST['site'], $_POST['lien'], $_POST['login'], $_POST['mdp'])) {
            echo "<script>alert('Accès modifié avec succès');</script>";
    
            header("Refresh:0");
    
            $log = "Modification d'accès mdp réussite  |  date:  ".$dateLog."  |  user:  ".$_POST['login']."  |  idAccès:  ".$id."  |  site:  ".$_POST['site']."  |  lien:  ".$_POST['lien']."  |  identifiant:  ".$_POST['login']."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";
    
            error_log($log, 3, "log.txt");
    
            exit();
        } else {
            echo "<script>alert('Erreur lors de la modification');</script>";
    
            $log = "Modification d'accès mdp échouée  |  date:  ".$dateLog."  |  user:  ".$_POST['login']."  |  idAccès:  ".$id."  |  cause:  ".$type[3]."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";
    
            error_log($log, 3, "log.txt");
        }
    } else {
        $mdpTest = $mdpManager -> testerMdp($_POST['mdp']);
        echo "<script>alert('Mot de passe trop faible ".$mdpTest."/4. Veuillez choisir un mot de passe plus robuste');</script>";

        $log = "Modification d'accès mdp échouée  |  date:  ".$dateLog."  |  user:  ".$_POST['login']."  |  idAccès:  ".$id."  |  cause:  ".$type[4]."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";

        error_log($log, 3, "log.txt");
    }   
}

?>