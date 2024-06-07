<?php 

try {
    $db_name = 'test'; // Nome do banco de dados
    $db_host = 'localhost:3306'; // Endereço do host do banco de dados
    $db_user = 'root'; // Usuário do banco de dados
    $db_password = ''; // Senha do banco de dados

    // Cria uma nova conexão PDO
    $conexao = new PDO("mysql:dbname=$db_name;host=$db_host", $db_user, $db_password);

    // Configura o PDO para lançar exceções em caso de erro
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $erro) {
    // Em caso de erro, exibe a mensagem de erro e o código
    echo "Erro na conexão: " . $erro->getMessage() . "<br>";
    echo "Código do erro: " . $erro->getCode();
    // Interrompe a execução do script
    exit();
}

?>
