<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
    <!-- Link para o arquivo de estilo CSS -->
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
            // Se não estiver logado, redireciona para a página de login necessária
            login_necessario();
        }
    ?>

    <div class="container">

    <!-- Título de boas-vindas, mostra o nome do usuário se estiver definido em um cookie -->
    <h1>Seja bem vindo, <?php if (isset($_COOKIE['nome'])) { echo $_COOKIE['nome']; }?>!</h1>
        <!-- Descrição do sistema -->
        <p>Sistema pertencente a clínica veterinária "Pets&Cia", desenvolvido para meios de coleta e atualizações de dados dos pacientes! </p>
        <p>Desenvolvido por Ariadne Saraiva dos Santos e Nubia Abreu de Oliveira sobre a matéria de Linguagem de Programação IV, com o professor Jônatas Cerqueira Dias do curso de ADS 
        da Fatec de Praia Grande. </p>

    </div>

</body>

</html>
