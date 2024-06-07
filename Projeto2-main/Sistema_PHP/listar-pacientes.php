<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes Cadastrados</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php

        // Inclui os módulos necessários para o funcionamento do sistema
        require 'modulos.php';
        require 'conexao.php';
        include 'menu.html';
        
        // Inicia uma sessão PHP
        session_start();

        // Verifica se o usuário está logado, If ternário
        echo ($_SESSION['logado']) ? '' : login_necessario();

    ?>


    <div class="container container-listagem">

        <ul>
            <?php 
                // Prepara a consulta SQL para obter todos os pacientes
                $dados = $conexao->prepare("SELECT * FROM clinica_veterinaria");
                $dados->execute(); // Executa a consulta

                // Inicializa um contador de pacientes listados
                $pacientesListados = 0;

                // Loop através da lista de pacientes
                while ($paciente = $dados->fetch(PDO::FETCH_OBJ) && $pacientesListados < 50) {
                    // Exibe os detalhes do paciente
                    echo "
                    <li>
                        <div class='dados'>
                            <a href='atualizar-paciente.php?id=$paciente->id&nome=$paciente->nome&nome_tutor=$paciente->nome_tutor&nome_tutora=$paciente->nome_tutora&endereco=$paciente->endereco&telefone=$paciente->telefone&usuario=$paciente->usuario'>
                                <span class='titulo-item-listagem'>
                                    $paciente->nome
                                </span> <br>
                                <div class='descricao-item-listagem'>
                                    <ul>
                                        <li>Telefone: $paciente->telefone</li>
                                        <li>Endereço: $paciente->endereco</li>
                                        <li>Usuário: $paciente->usuario</li>
                                    </ul>

                                </div>
                            </a>
                        </div>

                        <div class='icone-lista'>
                            <a href='excluir.php?id=$paciente->id' onclick=\"return confirm('Tem certeza que deseja excluir $paciente->nome?'); return false;\">
                                <img src='imagens/excluir.png' alt='Excluir'>
                            </a>
                        </div>

                    </li>";

                    // Incrementa o contador de pacientes listados
                    $pacientesListados++;
                }

                // Inicializa um array de pacientes
                $novos_pacientes = array(
                    array("id" => 1, "nome" => "Rex", "telefone" => "123456789"),
                    array("id" => 2, "nome" => "Bobby", "telefone" => "987654321"),
                    array("id" => 3, "nome" => "Luna", "telefone" => "555555555")
                );

                // Usa um loop for para percorrer o array de novos pacientes
                for ($i = 0; $i < count($novos_pacientes); $i++) {
                    $paciente_atual = $novos_pacientes[$i]; // Operador de atribuição

                    // Exibe os dados do paciente se o ID for maior que 1 (operador lógico e de incremento)
                    if ($paciente_atual["id"] > 1) {
                        echo "<li>Nome: " . $paciente_atual["nome"] . ", Telefone: " . $paciente_atual["telefone"] . "</li>";
                    }
                }
            ?>

        </ul>

    </div>

</body>

</html>


