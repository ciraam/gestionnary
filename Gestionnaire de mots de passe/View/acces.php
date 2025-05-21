<nav>
    <ul>
        <li>
            <button onclick="window.location.href='?action=insererAcces'">Insérer un accès</button>
        </li>         
    </ul>
</nav>

<form method="post">
    <fieldset>

        <label for="filtreAcces">Filtré par </label>
        <select name="filtreAcces" id="filtreAcces">
            <option value="1">Par défaut</option>
            <option value="2">Identifiant</option>
            <option value="3">Site</option>
        </select> </br>

        <label for="ordreAcces">Ordre </label>
        <select name="ordreAcces" id="ordreAcces">
            <option value="ASC">Croissant</option>
            <option value="DESC">Décroissant</option>
        </select> </br>

        <label for="nbrAcces">Par </label>
        <select name="nbrAcces" id="nbrAcces">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select> 

        <input type="submit" name="afficherAcces" id='afficherAcces' value='Afficher' class="button">
    </fieldset>
</form>

<?php 

//  voir pour copier le script pour mettre ici les filtres à jour en direct ?

$acces = new AccesManager();

if (isset($_POST['afficherAcces'])) {
    $accesMdp = $acces -> getAccesFiltre($_SESSION['login'], $_POST['filtreAcces'], $_POST['ordreAcces'], $_POST['nbrAcces']);
} else {
    $accesMdp = $acces -> getAcces($_SESSION['login']);
}

$mdp = new MdpManager();

echo '<table border="4">';
echo '<tr><th>Site web</th><th>Lien</th><th>Identifiant</th><th>Mot de passe</th></tr>';
echo "<hr>";
foreach ($accesMdp as $acc) {
    echo '<tr>';
    echo '<td>' .htmlspecialchars( $acc['site']) . '</td>';
    echo '<td><a href="' . htmlspecialchars($acc['lien']) . '">' . htmlspecialchars($acc['lien']) . '</a></td>';
    echo '<td>' . htmlspecialchars($acc['identifiant']) . '</td>';
    echo '<td><label>
                <input type="password" name="mdp[]" class="mdp-field" value="' . htmlspecialchars($mdp -> dechiffrerAsy($acc['mdp'])) . '" readonly>
                <div class="password-icon">
                    <i class="feather-eye" data-feather="eye"></i>
                    <i class="feather-eye-off" style="display: none;" data-feather="eye-off"></i>
                </div>
              </label>
          </td>';

    // $boutonModif = '<form method="post" action="?action=modifierAcces&user=' . $_SESSION['login'] . '&id=' . $acc['id'] . '"><input type="submit" name="modifierAcces" id="modifier" value="Modifier"></form>';
    // $boutonSuppr = '<form method="post" action="?action=supprimerAcces&user=' . $_SESSION['login'] . '&id=' . $acc['id'] . '"><input type="submit" name="supprimer" id="supprimer" value="Supprimer"></form>';

    // echo '<td>' . $boutonModif . '</td>';
    echo '<td>
            <form method="post">
                <input type="hidden" name="id" value="' . htmlspecialchars($acc['id']) . '">
                <input type="submit" name="modifier" value="Modifier">
            </form>
          </td>';
    // echo '<td>' . $boutonSuppr . '</td>';
    echo '<td>
            <form method="post">
                <input type="hidden" name="id" value="' . htmlspecialchars($acc['id']) . '">
                <input type="submit" name="supprimer" value="Supprimer">
            </form>
          </td>';
    echo '</tr>';
    
    if (isset($_POST['modifier'])) {
        $id = $_POST['id'];
        header("Location: ?action=modifierAcces&user=" . $_SESSION['login'] . "&id=" . $id);
        exit();
    }
    if (isset($_POST['supprimer'])) {
        $id = $_POST['id'];
        header("Location: ?action=supprimerAcces&user=" . $_SESSION['login'] . "&id=" . $id);
        exit();
    }
}

echo '</table>';
echo "</hr>";

?>

