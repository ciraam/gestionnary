<form method="POST">
    <input type="search" name="recherche" id="recherche" placeholder="site, identifiant, ...">
    <button type="button" name="rechercher" id="rechercher" class="button"><i class="bi bi-search"></i></button>
</form>

<?php

if (isset($_POST['rechercher'])) {
    $recherche = new AccesManager(); 
    // à finir
    // $recherche -> rechercherAcces($_POST['rechercher']);

}

?>

<div>fenetre gauche</div>
<div><?php require_once("View/acces.php"); ?></div>