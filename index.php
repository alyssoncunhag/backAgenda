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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de Contatos</title>

    <!-- Vinculando a folha de estilos externa -->
    <link rel="stylesheet" href="css/index.css">
    <!-- Adicionando o FontAwesome para os ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="wrapper">
        <header class="header">
            <h1 class="logo">Agenda Senac</h1>
            <nav class="nav">
                <a href="indexUsuarios.php" class="btn-main"><i class="fas fa-home"></i> Gerenciar Usuários</a>
                <a href="sair.php" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </header>

        <main class="main-content">
        <section class="contact-actions" style="text-align: right;"> 
    <a href="adicionarContato.php" class="add-contact-button"><i class="fas fa-plus"></i> Adicionar Contato</a>
</section>


            <section class="contact-table">
                <div class="table-wrapper">
                    <table class="table user-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Endereço</th>
                                <th>Data de Nascimento</th>
                                <th>Descrição</th>
                                <th>LinkedIn</th>
                                <th>Email</th>
                                <th>Foto</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $lista = $contato->listar();
                            foreach ($lista as $item):
                            ?>
                            <tr>
                                <td><?php echo $item['id']; ?></td>
                                <td><?php echo $item['nome']; ?></td>
                                <td><?php echo $item['telefone']; ?></td>
                                <td><?php echo $item['endereco']; ?></td>
                                <td><?php echo $item['dt_nasc']; ?></td>
                                <td><?php echo $item['descricao']; ?></td>
                                <td><?php echo $item['linkedin']; ?></td>
                                <td><?php echo $item['email']; ?></td>
                                <td>
                                    <?php if (!empty($item['foto'])): ?>
                                        <img src="img/contatos/<?php echo $item['foto']; ?>" alt="Foto de <?php echo $item['nome']; ?>" class="contact-photo">
                                    <?php endif; ?>
                                </td>
                                <td class="actions">
                                    <?php if ($usuarios->temPermissoes('EDIT')): ?>
                                        <a href="editarContato.php?id=<?php echo $item['id']; ?>" class="btn-action btn-edit"><i class="fas fa-edit"></i> Editar</a>
                                    <?php endif; ?>
                                    <?php if ($usuarios->temPermissoes('DELETE')): ?>
                                        <a href="excluirContato.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Tem certeza que vai excluir esse contato?')" class="btn-action btn-delete"><i class="fas fa-trash-alt"></i> Excluir</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

</body>
</html>
