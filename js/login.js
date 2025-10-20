$(function() {
    // função reutilizável para mostrar alertas bonitos
    window.showAlert = function(message) {
        alert(message); // simples; se quiser, pode substituir por modal do Bootstrap
    };


    $('#loginForm').on('submit', function(e) {
        var user = $('input[name="username"]').val().trim();
        var password = $('input[name="password"]').val().trim();

        if (!user || !password) {
            e.preventDefault();
            alert('Preencha usuário e senha.');
            return false;
        }
        // deixa o form submeter normalmente (POST para php/login.php)
    });
});