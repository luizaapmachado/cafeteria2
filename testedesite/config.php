<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cafeteria";

$conexao = new mysqli($servername, $username, $password, $dbname);

if ($conexao->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}