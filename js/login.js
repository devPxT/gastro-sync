$(function() {
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