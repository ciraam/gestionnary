// pour masquer/afficher le mot de passe

feather.replace();

const eye = document.querySelector(".feather-eye");
const eyeoff = document.querySelector(".feather-eye-off");
const passwordField = document.querySelector("input[type=password]");

eye.addEventListener("click", () => {
    eye.style.display = "none";
    eyeoff.style.display = "block";
    passwordField.type = "text";
});
  
eyeoff.addEventListener("click", () => {
    eyeoff.style.display = "none";
    eye.style.display = "block";
    passwordField.type = "password";
});

feather.replace();
document.querySelectorAll(".mdp-field").forEach((passwordField, index) => {
    const eye = passwordField.nextElementSibling.querySelector(".feather-eye");
    const eyeoff = passwordField.nextElementSibling.querySelector(".feather-eye-off");

    eye.addEventListener("click", () => {
        eye.style.display = "none";
        eyeoff.style.display = "block";
        passwordField.type = "text";
    });

    eyeoff.addEventListener("click", () => {
        eyeoff.style.display = "none";
        eye.style.display = "block";
        passwordField.type = "password";
    });
});


