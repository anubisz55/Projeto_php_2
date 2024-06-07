<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Atualizar Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php 
        // Inclui os módulos necessários para o funcionamento do sistema
        require 'modulos.php';
        // Inclui o menu de navegação
        include 'menu.html';
        // Inicia uma sessão PHP
        session_start();
        // Verifica se o usuário está logado
        if ($_SESSION['logado'] != true) {
            // Chama a função que exige login
            login_necessario();
        }
    ?>

    <div class="container container-cadastro">

        <h2>Atualização de usuário</h2>
        <!-- Formulário para atualização dos dados do paciente -->
        <form action="" method="POST">
            <!-- Campo oculto para enviar o ID do paciente -->
            <p><input type="hidden" name="id" value=<?php echo $_GET['id'] ?>></p>
            <!-- Campo para inserir o novo nome -->
            <p>Nome:<input type="text" name="nome" placeholder="Digite novo nome" value='<?php echo $_GET['nome']?>'>
            </p>
            <!-- Campo para inserir o novo nome do primeiro tutor -->
            <p>Nome do 1º Tutor:<input type="text" name="nome_tutor" placeholder="Digite o nome do novo tutor" value='<?php echo $_GET['nome']?>'>
            </p>
            <!-- Campo para inserir o novo nome do segundo tutor -->
            <p>Nome do 2° Tutor:<input type="text" name="nome_tutora" placeholder="Digite o nome do novo tutor" value='<?php echo $_GET['nome']?>'>
            </p>
            <!-- Campo para inserir o novo endereço -->
            <p>Endereço:<input type="text" name="endereco" placeholder="Digite novo endereço"
                    value='<?php echo $_GET['endereco']?>'></p>
            <!-- Campo para inserir o novo número de telefone -->
            <p>Telefone:<input type="text" name="telefone" placeholder="Digite novo número de telefone"
                    value='<?php echo $_GET['telefone']?>'></p>
            <!-- Campo para inserir o novo usuário -->
            <p>Usuário: <input type="text" name="usuario" placeholder="Digite um novo"
                    value='<?php echo $_GET['usuario']?>'><span id='aviso-usuario'></span></p>
            <!--<p>Senha: <input type="password" name="senha" placeholder="Digite sua senha aqui"></p> -->
            <!-- Botão de enviar o formulário para atualização -->
            <input type="submit" name="atualizar" value="Atualizar">
        </form>

    </div>

</body>

</html>

<?php 
    // Inclui o arquivo de conexão com o banco de dados
    require 'conexao.php';
    
    // Verifica se o formulário foi submetido
    if (isset($_POST['atualizar'])) {
        // Obtém os dados enviados pelo formulário
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $nome_tutor = $_POST['nome_tutor'];
        $nome_tutora = $_POST['nome_tutora'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $usuario = $_POST['usuario'];
        
        // Verifica se o usuário já existe
        if (existe_usuario($usuario, $_GET['usuario'])) { 
            // Exibe aviso se o usuário já existe
            aviso_usuario_existente();
        } else {
            // Prepara e executa a consulta SQL para atualizar os dados do paciente
            $atualizacao = $conexao->prepare("UPDATE pacientes SET nome=:nome, nome_tutor=:nome_tutor, nome_tutora=:nome_tutora,endereco=:endereco, telefone=:telefone, usuario=:usuario WHERE id=:id;");
            $atualizacao->bindValue(':nome', $nome);
            $atualizacao->bindValue(':nome_tutor', $nome_tutor);
            $atualizacao->bindValue(':nome_tutora', $nome_tutora);
            $atualizacao->bindValue(':endereco', $endereco);
            $atualizacao->bindValue(':telefone', $telefone);
            $atualizacao->bindValue(':usuario', $usuario);
            $atualizacao->bindValue(':id', $id);
            $atualizacao->execute();
            // Redireciona para a página de listagem de pacientes após a atualização
            header('location:listar-pacientes.php');
        }
    }
?>
