<form method="post">
        <fieldset>
            <legend>Veuillez rentrer votre identifiant & votre mail pour l'envoi d'un email de réinitialisation</legend>
            <label for="login">Identifiant</label></br>
            <input type="text" name="login" id="login" placeholder="ex : daponT"></br> 
            <label for="login">Mail</label></br>
            <input type="email" name="mail" id="mail" placeholder="ex : david.dupont@example.com"></br> 
            <input type="submit" name="envoyer" id='envoyer' value='Envoyer' class="button"></br>
        </fieldset>
</form>
<a href="?action=connexion">Revenir à la page de connexion</a>

<?php

if (isset($_POST['envoyer']) && isset($_POST['login']) && isset($_POST['mail'])) {
    $dateLog = date('d.m.Y H:i:s');

    if(!empty($_POST['login']) && !empty($_POST['mail'])) {
        $utilisateurManager = new UtilisateurManager();
        $utilisateurLogin = $utilisateurManager -> getUtilisateurs($_POST['login']);
        $utilisateurMail = $utilisateurManager -> verifierMail($_POST['mail']);
        
        if ($utilisateurLogin == true) {
            if ($utilisateurMail == true) {
                $sujet = 'Réinitialisation de votre mot de passe Gestionnary';
                $message = "
                <html>
                <head>
                    <title>Réinitialisation de mot de passe Gestionnary</title>
                </head>
                <body>
                    <p>Vous avez demandé à réinitialiser votre mot de passe. Cliquez sur le lien ci-dessous pour réinitialiser :</p>
                    <a href=''>Réinitialiser votre mot de passe</a>
                </body>
                </html>";
        
                if(mail($utilisateurMail['mail'], $sujet, $message)) {
                    echo "<script>alert('Un email de réinitialisation a été envoyé');</script>";
        
                    $log = "Email de réinitialisation envoyé  |  date:  ".$dateLog."  |  login:  ".$_POST['login']."  |  mail:  ".$utilisateurMail['mail']."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";
        
                    error_log($log, 3, "log.txt");
                } else {
                    echo "<script>alert('Échec de l'envoi de l'email de réinitialisation');</script>";
        
                    $log = "Email de réinitialisation non envoyé  |  date:  ".$dateLog."  |  login:  ".$_POST['login']."  |  mail:  ".$utilisateurMail['mail']."  |  cause:  ".$type[1]."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";
        
                    error_log($log, 3, "log.txt");
                }
            } else {
                echo "<script>alert('Adresse mail non-enregistrée');</script>";
        
                $log = "Email de réinitialisation non envoyé  |  date:  ".$dateLog."  |  login:  ".$_POST['login']."  |  mail:  ".$utilisateurMail['mail']."  |  cause:  ".$type[7]."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";
        
                error_log($log, 3, "log.txt");
            }
        } else {
            echo "<script>alert('Identifiant non-enregistré');</script>";
        
            $log = "Email de réinitialisation non envoyé  |  date:  ".$dateLog."  |  login:  ".$_POST['login']."  |  mail:  ".$utilisateurMail['mail']."  |  cause:  ".$type[8]."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";
        
            error_log($log, 3, "log.txt");
        }
    } else {
        $log = "Email de réinitialisation non envoyé  |  date:  ".$dateLog."  |  cause:  ".$type[2]."  |  IP : ".$_SERVER['REMOTE_ADDR']."\n";

        echo "<script>alert('Veuillez remplir tous les champs');</script>";
            
        error_log($log, 3, "log.txt");
    }       
}

?>
