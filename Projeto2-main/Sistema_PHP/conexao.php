<?php 

try {
    $db_name = 'clinica_veterinaria'; // Nome do banco de dados
    $db_host = 'localhost:3306'; // Endereço do host do banco de dados
    $db_user = 'root'; // Usuário do banco de dados
    $db_password = ''; // Senha do banco de dados

    // Cria uma nova conexão PDO
    $conexao = new PDO("mysql:dbname=$db_name;host=$db_host", $db_user, $db_password);

    // Configura o PDO para lançar exceções em caso de erro
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria a tabela pacientes se não existir
    $sql = "CREATE TABLE IF NOT EXISTS pacientes (
        id INT PRIMARY KEY,
        nome_paciente VARCHAR(50),
        nome_tutor VARCHAR(50),
        nome_tutora VARCHAR(50),
        endereco VARCHAR(100),
        telefone VARCHAR(20),
        senha VARCHAR(20)
    )";
    $conexao->exec($sql);

    // Insere os dados na tabela pacientes
    $sql = "INSERT INTO pacientes (id, nome_paciente, nome_tutor, nome_tutora, endereco, telefone, senha) VALUES
    (1, 'Rex', 'João Silva', 'Maria Silva', 'Rua das Flores, 123', '(11) 1234-5678', '12345'),
    (2, 'Luna', 'Carlos Souza', 'Ana Souza', 'Av. dos Jacarandás, 456', '(21) 2345-6789', '67890'),
    (3, 'Max', 'Pedro Lima', 'Paula Lima', 'Rua dos Lírios, 789', '(31) 3456-7890', '54321'),
    (4, 'Bella', 'Lucas Pereira', 'Juliana Pereira', 'Av. das Orquídeas, 101', '(41) 4567-8901', '09876'),
    (5, 'Thor', 'André Costa', 'Camila Costa', 'Rua das Acácias, 202', '(51) 5678-9012', '11223')
    ON DUPLICATE KEY UPDATE
    nome_paciente=VALUES(nome_paciente),
    nome_tutor=VALUES(nome_tutor),
    nome_tutora=VALUES(nome_tutora),
    endereco=VALUES(endereco),
    telefone=VALUES(telefone),
    senha=VALUES(senha)";
    
    $conexao->exec($sql);

    echo "Tabela 'pacientes' criada e dados inseridos com sucesso.";

} catch (PDOException $erro) {
    // Em caso de erro, exibe a mensagem de erro e o código
    echo "Erro na conexão: " . $erro->getMessage() . "<br>";
    echo "Código do erro: " . $erro->getCode();
    // Interrompe a execução do script
    exit();
}

?>


