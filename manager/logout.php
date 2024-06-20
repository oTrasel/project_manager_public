<?php
session_start();
include('conexao.php');

if(isset($_SESSION['autenticado'])) {
    session_destroy();
    header('Location: ../index.php');
}

?>