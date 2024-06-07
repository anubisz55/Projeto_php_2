<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAI FORA INTRUSO</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php 
        // Inclui o menu de navegação
        include 'menu.html';
    ?>

    <center>
        <!-- Mensagem para intrusos -->
        <div>
            <h1>Você é intruso!</h1> <br>
            <p>Faça login para continuar</p>
            <!-- Link para a página de login -->
            <a href="login.php">
                <div class="botao">Login</div>
            </a>
        </div>
    </center>

</body>

</html>
