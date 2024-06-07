<?php 
    // Inclui o arquivo de conexão com o banco de dados
    require 'conexao.php';
    // Inclui os módulos necessários para o funcionamento do sistema
    require 'modulos.php';
    // Inicia uma sessão PHP
    session_start();

    // Verifica se o usuário está logado
    if ($_SESSION['logado'])
    {
        try{
            // Obtém o ID do paciente a ser deletado da URL
            $id = $_GET['id'];
            // Prepara e executa a consulta SQL para deletar o paciente
            $deletar = $conexao->prepare("DELETE FROM pacientes WHERE id = '$id';");
            $deletar->execute();
            // Redireciona para a página de listagem de pacientes após a exclusão
            header('location:listar-pacientes.php');
        } catch (Exception $erro) {
            // Exibe uma mensagem de erro se a exclusão não puder ser concluída
            echo "<h1> NÃO FOI POSSÍVEL CONCLUIR! </h1> <br> $erro->getMessage() <br><br> <a href=listar-pacientes.php>Voltar para listagem</a> ";
        }

    } else {
        // Se o usuário não estiver logado, exige o login
        login_necessario();
    }

?>
