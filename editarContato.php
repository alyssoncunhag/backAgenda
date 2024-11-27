<?php
session_start();
include 'classes/contatos.class.php';
include 'classes/usuarios.class.php';

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

$contato = new Contatos();
$usuarios = new Usuarios();
$usuarios->setUsuario($_SESSION['logado']);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $contatoInfo = $contato->buscar($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $dt_nasc = $_POST['dt_nasc'];
    $descricao = $_POST['descricao'];
    $linkedin = $_POST['linkedin'];
    $email = $_POST['email'];
    $foto = $_FILES['foto'];
    $excluirFoto = isset($_POST['excluir_foto']) ? true : false; // Verifica se o usuário optou por excluir a foto

    // Se o usuário escolheu excluir a foto, apaga o arquivo do servidor
    if ($excluirFoto) {
        $fotoPath = 'img/contatos/' . $contatoInfo['foto'];
        if (file_exists($fotoPath)) {
            unlink($fotoPath); // Deleta a foto do servidor
        }
        $fotoNome = null; // Remove a referência no banco
    } else {
        // Caso contrário, faz o upload de uma nova foto se o usuário enviou uma
        if (!empty($foto['name'])) {
            $fotoNome = md5(time() . rand(0, 9999)) . '.jpg';
            $fotoPath = 'img/contatos/' . $fotoNome;

            if (move_uploaded_file($foto['tmp_name'], $fotoPath)) {
                // Foto foi carregada com sucesso
            }
        } else {
            // Caso não tenha enviado uma nova foto, mantém a foto atual
            $fotoNome = $contatoInfo['foto'];
        }
    }

    // Atualiza os dados do contato, incluindo a foto
    $contato->editar($nome, $telefone, $endereco, $dt_nasc, $descricao, $linkedin, $email, $fotoNome, $id);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contato</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/editarContato.css"> <!-- Link para o arquivo CSS que vamos usar -->
</head>
<body>
    <div class="container">
        <h1>Editar Contato</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $contatoInfo['id']; ?>">
            
            <!-- Nome -->
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $contatoInfo['nome']; ?>" required>
            </div>

            <!-- Telefone -->
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $contatoInfo['telefone']; ?>" required>
            </div>

            <!-- Endereço -->
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $contatoInfo['endereco']; ?>" required>
            </div>

            <!-- Data de Nascimento -->
            <div class="form-group">
                <label for="dt_nasc">Data de Nascimento:</label>
                <input type="date" class="form-control" id="dt_nasc" name="dt_nasc" value="<?php echo $contatoInfo['dt_nasc']; ?>" required>
            </div>

            <!-- Descrição -->
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" required><?php echo $contatoInfo['descricao']; ?></textarea>
            </div>

            <!-- LinkedIn -->
            <div class="form-group">
                <label for="linkedin">LinkedIn:</label>
                <input type="text" class="form-control" id="linkedin" name="linkedin" value="<?php echo $contatoInfo['linkedin']; ?>" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $contatoInfo['email']; ?>" required>
            </div>

            <!-- Foto -->
            <div class="form-group">
    <label for="foto">Foto:</label>
    <input type="file" class="form-control" id="foto" name="foto">
    <img src="img/contatos/<?php echo $contatoInfo['foto']; ?>" alt="Foto atual" width="100"><br>
    
    <!-- Texto acima do checkbox de excluir foto -->
    <div class="form-check">
        <label class="form-check-label" for="excluir_foto">
            Excluir foto atual
        </label>
        <input type="checkbox" class="form-check-input" name="excluir_foto" value="1" id="excluir_foto">
    </div>
</div>



            <!-- Botão de submit -->
            <button type="submit" class="btn btn-custom">Salvar</button>
        </form>
    </div>
</body>
</html>
