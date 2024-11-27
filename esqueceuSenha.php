<?php
require 'classes/usuarios.class.php';

if (!empty($_POST['email'])) {
    $email = addslashes($_POST['email']);
    $usuarios = new Usuarios();

    if ($usuarios->verificarEmail($email)) {
        // Se o email existe no banco, redireciona para redefinir nova senha
        header("Location: redefinirSenha.php?email=" . urlencode($email));
        exit;
    } else {
        $erro = "E-mail não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu a senha</title>
    <link rel="stylesheet" href="css/esqueceuSenha.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Esqueceu sua senha</h1>
            </div>
            <div class="card-body">
                <?php if (isset($erro)): ?>
                    <div class="alert-danger">
                        <?= $erro; ?>
                    </div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="email">Digite seu e-mail:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <button type="submit" class="btn-primary">Verificar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
