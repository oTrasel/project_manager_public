<?php
include('manager/verifica_login.php');

ini_set('default_charset','UTF-8');

if(isset($_SESSION['nome'])){
  $nome = substr($_SESSION['nome'], 0, strpos($_SESSION['nome'], ' '));
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/icons/font/bootstrap-icons.css"/>
    <title>Projetos</title>
</head>
<body>

    <button><a href="novo_projeto.php">Novo Projeto</a></button>
    <br><br>
    <?php
     if (isset($_SESSION['projetos'])) {
      foreach ($_SESSION['projetos'] as $projeto) {
          foreach ($projeto as $campo => $valor) {
            echo"<button class='btn btn-outline-dark me-2'>"."$campo: $valor</button>";
          }
          echo "<br>";
          echo "<br>";
      }
  }
    ?>



</body>
</html>