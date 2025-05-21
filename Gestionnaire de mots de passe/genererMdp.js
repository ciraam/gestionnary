// pour générer un mot de passe robuste & aléatoire utilisant une requête AJAX

document.getElementById('generatePasswordBtn').addEventListener('click', function() {
    fetch('View/genererMdp.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('mdp').value = data;
        })
        .catch(error => {
            console.error('Erreur lors de la génération du mot de passe:', error);
        });
});