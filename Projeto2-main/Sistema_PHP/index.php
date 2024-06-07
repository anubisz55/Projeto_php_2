<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
            
        // Verifica se o usuário não está logado
        if ($_SESSION['logado'] !=true):
    ?>


    <div class="container container-login">
        <!-- Formulário de login -->
        <form action="" method="POST">
            <center>
                <h2>Sistema Colaboradores</h2>
            </center>
            <h3>Login</h3>
            <!-- Campo para inserir o nome de usuário -->
            <p>Usuário<input type="text" name="usuario" placeholder="Digite seu usuário..." value=<?php if (isset( $_COOKIE['usuario'] )) {
                        echo $_COOKIE['usuario'];
                        } ?>></p>
            <!-- Campo para inserir a senha -->
            <p>Senha<input type="password" name="senha" placeholder="Digite sua senha..."></p>
            <!-- Div para exibir avisos -->
            <div id='aviso'></div>
            <!-- Botão de enviar o formulário para login -->
            <input type="submit" name="entrar" value="Entrar">
        </form>
    </div>


    <?php 
        else:
            // Redireciona para a página inicial se o usuário já estiver logado
            header('location:pagina-inicial.php');
        endif;
    ?>

</body>

</html>

<?php 

    // Verifica se o formulário de login foi submetido
    if(isset($_POST['entrar'])) {
        // Inclui o arquivo de conexão com o banco de dados
        require 'conexao.php';

        // Obtém o nome de usuário e senha enviados pelo formulário
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        // Salva o nome de usuário em um cookie
        setcookie('usuario', $usuario);

        // Verifica se o usuário é o admin e a senha é 'admin'
        if ($usuario == 'admin' AND $senha == 'admin' ) {
            // Define a sessão como logada e redireciona para a página inicial
            $_SESSION['logado'] = true;
            header('location:pagina-inicial.php');
        }

        // Prepara e executa a consulta SQL para verificar o usuário e senha
        $dados = $conexao->prepare("SELECT senha, nome FROM pacientes WHERE usuario = :usuario;");
        $dados->bindValue(':usuario', $usuario);
        $dados->execute();

        // Verifica se existem resultados na consulta
        if ($dados->rowCount() > 0) {
            // Obtém os dados do usuário
            $senha_bd = $dados->fetchAll(PDO::FETCH_OBJ);

            // Verifica se a senha digitada coincide com a senha do banco de dados
            foreach ($senha_bd as $user) {
                if (password_verify($senha, $user->senha)){
                    // Define a sessão como logada, define um cookie com o nome do usuário e redireciona para a página inicial
                    echo "Tudo certo!";
                    setcookie('nome', $user->nome);
                    $_SESSION['logado'] = true;
                    header('location:pagina-inicial.php');

                } else {
                    // Exibe aviso se o usuário ou senha estiverem incorretos
                    aviso_usuario_senha_incorretos();
                }
            }
        } else {
            // Exibe aviso se o usuário ou senha estiverem incorretos
            aviso_usuario_senha_incorretos();
        }

    }

?>
