<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar</title>
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
        echo ($_SESSION['logado']) ? '' : login_necessario();
        ?>

    <div class="container container-cadastro">

        <h2>Cadastro de usuário</h2>
        <!-- Formulário para cadastrar um novo usuário -->
        <form action="" method="POST">
            <!-- Campo para inserir o nome do usuário -->
            <p>Nome:<input type="text" name="nome" placeholder="Digite o nome"></p>
            <!-- Campo para inserir o nome do primeiro tutor -->
            <p>Nome do 1° Tutor:<input type="text" name="nome_tutor" placeholder="Digite o nome do 1º Tutor"></p>
            <!-- Campo para inserir o nome do segundo tutor -->
            <p>Nome do 2º Tutor:<input type="text" name="nome_tutora" placeholder="Digite o nome do 2º Tutor"></p>
            <!-- Campo para inserir o endereço -->
            <p>Endereço:<input type="text" name="endereco" placeholder="Digite o endereço"></p>
            <!-- Campo para inserir o número de telefone -->
            <p>Telefone:<input type="text" name="telefone" placeholder="Digite o número de telefone"></p>
            <!-- Campo para inserir o nome de usuário -->
            <p>Usuário: <span id='aviso-usuario'></span>

                <input type="text" name="usuario" placeholder="Digite um usuário único">
            </p>
            <!-- Campo para inserir a senha -->
            <p>Senha: <input type="password" name="senha" placeholder="Digite a senha aqui"></p>
            <!-- Botão de enviar o formulário para cadastro -->
            <input type="submit" name="cadastrar" value="Cadastrar">
        </form>

    </div>

  


</body>

</html>

<?php 
    // Variável para verificar se o usuário foi cadastrado com sucesso
    $cadastrado = false;
    // Variável para verificar se o usuário já existe
    $usuario_existente = false;
    // Inclui o arquivo de conexão com o banco de dados
    require 'conexao.php';

    // Verifica se o formulário foi submetido
    if (isset($_POST['cadastrar'])) {

        // Verifica se o usuário já existe
        if (existe_usuario($_POST['usuario'])) {
            // Exibe aviso se o usuário já existe
            aviso_usuario_existente();
        } else {
            // Obtém os dados enviados pelo formulário
            $nome = $_POST['nome'];
            $nome_tutor = $_POST['nome_tutor'];
            $nome_tutora = $_POST['nome_tutora'];
            $endereco = $_POST['endereco'];
            $telefone = $_POST['telefone'];
            $usuario = $_POST['usuario'];
            // Criptografa a senha antes de armazenar no banco de dados
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            // Prepara e executa a consulta SQL para cadastrar o novo usuário
            $cadastro = $conexao->prepare(
                "INSERT INTO test (nome, endereco, nome_tutor, nome_tutora, telefone, usuario, senha) VALUES (:nome, :nome_tutor, :nome_tutora, :endereco, :telefone, :usuario, :senha);"
            );
            $cadastro->bindValue(":nome", $nome);
            $cadastro->bindValue(":nome_tutor", $nome_tutor);
            $cadastro->bindValue(":nome_tutora", $nome_tutora);
            $cadastro->bindValue(":endereco", $endereco);
            $cadastro->bindValue(":telefone", $telefone);
            $cadastro->bindValue(":usuario", $usuario);
            $cadastro->bindValue(":senha", $senha);
            $cadastro->execute();
            $cadastrado = true;
        }

    }

    // Se o usuário foi cadastrado com sucesso, exibe uma mensagem
    if ($cadastrado):
?>

<script>
// Exibe uma mensagem de sucesso após o cadastro
alert('Cadastrado com sucesso!')
</script>


<?php 
    endif
?>
