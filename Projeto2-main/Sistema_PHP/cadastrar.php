<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 

// Inclui o menu de navegação
include 'menu.html';

// Inicia uma sessão PHP
session_start();
// Verifica se o usuário está logado
echo ($_SESSION['logado']) ? '' : login_necessario();
?><h1>Cadastrar Usuário</h1>
<form method="POST" action="cadastrar_action.php">
<label>
Nome: <input type="text" name="nome"/>
</label>
<label>
Email: <input type="text" name="email"/>
</label>
<input type="submit" value="Salvar"/>

</form>
</body>
</html>
