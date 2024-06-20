<?php
include('manager/verifica_login.php');
ini_set('default_charset','UTF-8');

if(isset($_SESSION['nome'])){
  $nome = $_SESSION['nome'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/icons/font/bootstrap-icons.css"/>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/outros/jquery-3.6.4.js"></script>
    <title>Home</title>
</head>
<body>
  <nav class="navbar bg-dark" data-bs-theme="dark">
    <form class="container-fluid justify-content-start">
      <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Olá <?php echo $nome;?></button>
    </form>
  </nav>
  
  <div class="offcanvas offcanvas-start bg-dark" data-bs-theme="dark" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Olá <?php echo $nome;?>  </h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <button class="btn btn-primary"><a href="projetos.php">projetos</a></button>
      <p>Configurações</p>
      <button class="btn btn-danger"><a href="manager/logout.php">Logout</a></button>
  </div>
</body>
</html>