// Función para alternar entre los formularios de login y registro con animaciones
function toggleForm() {
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");

    // Si el formulario de login está visible, lo ocultamos y mostramos el de registro
    if (loginForm.style.display === "block" || loginForm.style.display === "") {
        loginForm.style.display = "none";
        registerForm.style.display = "block";
        setTimeout(() => {
            registerForm.classList.add("show");
        }, 10);
    } else {
        // Si el formulario de registro está visible, lo ocultamos y mostramos el de login
        registerForm.classList.remove("show");
        setTimeout(() => {
            registerForm.style.display = "none";
            loginForm.style.display = "block";
        }, 300);
    }
}
