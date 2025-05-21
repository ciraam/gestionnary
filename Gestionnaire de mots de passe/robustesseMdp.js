// pour la robustesse du mot de passe sous forme de barre de progression

document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('mdp');
    const progressBar = document.getElementById('progression');

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = checkPasswordStrength(password);

        progressBar.style.width = strength.width;
        progressBar.className = strength.className;
    });

    function checkPasswordStrength(password) {
        let strength = { width: '0%', className: '' };

        if (password.length < 6) {
            strength.width = '20%';
            strength.className = 'faible';
            return strength;
        }

        let score = 0;
        if (/[a-z]/.test(password)) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^a-zA-Z0-9]/.test(password)) score++;

        if (score === 1) {
            strength.width = '25%';
            strength.className = 'faible';
        } else if (score === 2) {
            strength.width = '50%';
            strength.className = 'moyen';
        } else if (score === 3) {
            strength.width = '75%';
            strength.className = 'fort';
        } else if (score === 4) {
            strength.width = '100%';
            strength.className = 'robuste';
        }

        return strength;
    }
});
