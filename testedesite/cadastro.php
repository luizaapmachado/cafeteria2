<?php
// Incluindo o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verificando se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capturando os dados do formulário de endereço
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $cep = $_POST['cep'];
    $email = $_POST['email']; // Email como chave estrangeira

    // Validação básica (verificando se os campos obrigatórios estão preenchidos)
    if (!empty($rua) && !empty($numero) && !empty($bairro) && !empty($cidade) && !empty($cep) && !empty($email)) {

        // Preparando a consulta SQL para inserção
        $sql = "INSERT INTO Endereco_Entrega (email, rua, numero, complemento, bairro, cidade, cep) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Preparando a declaração (prepared statement) para evitar SQL injection
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $email, $rua, $numero, $complemento, $bairro, $cidade, $cep);

        // Executando a inserção
        if ($stmt->execute()) {
            echo "Endereço cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o endereço: " . $conn->error;
        }

        // Fechando a declaração e a conexão
        $stmt->close();
        $conn->close();

    } else {
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
}

session_start();
if (isset($_POST['submit'])) 
    include_once("config.php");


function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['submit'])) {

    $nome = sanitizeInput($_POST['name']);
    $cpf = sanitizeInput($_POST['cpf']);
    $telefone = sanitizeInput($_POST['telefone']);
    $email = sanitizeInput($_POST['email']);
    $nome_usuario = sanitizeInput($_POST['nome_usuario']);
    $senha = sanitizeInput($_POST['senha']);

    $cpf_check_query = "SELECT * FROM cadastro WHERE cpf = '$cpf' LIMIT 1";
    $cpf_check_result = mysqli_query($conexao, $cpf_check_query);
    if (mysqli_num_rows($cpf_check_result) > 0) {
        $error_message = 'CPF já cadastrado.';
    }
    
    $sql = "INSERT INTO cadastro (nome, cpf, telefone, email, nome_usuario, senha) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('ssssss', $nome, $cpf, $telefone, $email, $nome_usuario, $senha);

    if ($stmt->execute()) {
        echo "<p class='success'>Usuário cadastrado com sucesso!</p>";
    } else {
        echo "<p class='error'>Falha ao cadastrar usuário: " . $conexao->error . "</p>";
    }

    $stmt->close();
}
?>
