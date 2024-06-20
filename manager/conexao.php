<?php
// Define os parâmetros de conexão
$host = "localhost"; 
$database = "project_manager";
//$user = "trasel";
//$password = "aaaaaaaaa";
$user = "root";
$password = "";

// Cria a string de conexão com o SQL Server
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$dsn = "mysql:host=$host;dbname=$database";

// Cria a conexão
try {
    $pdo = new PDO($dsn, $user, $password);
} catch(PDOException $e) {

    echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Erro ao conectar com o Banco de Dados')
        </SCRIPT>");

    echo $e->getMessage();

}
?>