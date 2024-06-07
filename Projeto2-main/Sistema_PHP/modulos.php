<?php 

    // Inclui o arquivo de conexão com o banco de dados
    require 'conexao.php';

    // Função para verificar se um usuário já existe no banco de dados
    function existe_usuario($user_post, $excecao = null)
    {
        // Requer novamente o arquivo de conexão com o banco de dados
        require 'conexao.php';
        // Prepara e executa a consulta SQL para obter todos os usuários
        $dados = $conexao->prepare("SELECT usuario FROM clinica_veterinaria;");
        $dados->execute();
        // Obtém todos os usuários do banco de dados
        $users = $dados->fetchAll(PDO::FETCH_OBJ);
        // Percorre todos os usuários para verificar se o usuário já existe
        foreach($users as $user) {
            if ($user_post == $user->usuario AND $user_post != $excecao) {
                return true;
            } 
        }
        // Retorna falso se o usuário não existe
        return false;
    }

    // Função para exibir um aviso quando um usuário já existe
    function aviso_usuario_existente()
    {
        echo '
            <script>
            // Obtém o elemento de aviso de usuário existente
            var aviso = document.getElementById("aviso-usuario")
            // Define o texto do aviso
            aviso.textContent = "Usuário já existente!"
            </script>
        ';
    }

    // Função para exibir um aviso quando o usuário ou a senha estão incorretos
    function aviso_usuario_senha_incorretos()
    {
        echo "
            <script>
            // Obtém o elemento de aviso de usuário ou senha incorretos
            var aviso = document.getElementById('aviso')
            // Define o texto do aviso
            aviso.textContent = 'Ops, usuário ou senha incorretos!'
            </script>
        ";
    }

    // Função para redirecionar para a página de saída quando o login é necessário
    function login_necessario() 
    {
        header('location:sai-intruso.php');
    }   

?>
