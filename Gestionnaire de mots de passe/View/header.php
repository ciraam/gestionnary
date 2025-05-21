<!DOCTYPE html>
<html>
    <header>
        <title><?php echo $title ?></title>
        <meta charset="utf-8">
    </header>
<body>
<h3>Gestionnary</h3>
<?php $text = $_SESSION['nom'] . " " . $_SESSION['prenom'] ?> 
<h4>Bonjour <?php echo htmlspecialchars($text, ENT_SUBSTITUTE); ?> alias <?php echo htmlspecialchars($_SESSION['login'].", nous sommes le ".date("d-m-Y"), ENT_SUBSTITUTE); ?></h4>

    <nav>
        <ul>
            <li>
                <button onclick="window.location.href='?action=accueil'">Accueil</button>
            </li>
            <form action="" method="post"><input type="submit" name="deconnexion" value="Se déconnecter"></form>
            
        </ul>
    </nav>
            <?php
                if(isset($_POST['deconnexion'])){
                    session_destroy();
                    $_SESSION = array();
                    $_SESSION['id'] = null;
                    $_GET['action'] = '.';
                    header('Location: ?action=connexion');
                    // exit();
                }
            ?>
    </nav>
    