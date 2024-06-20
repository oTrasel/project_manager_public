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
    <script src="js/jquery.min.js"></script>
    <script src="js/paginas/cadastro_projeto.js"></script>
    <title>Novo Projeto</title>
</head>
<body>
    <form action="manager/cadastro_projeto.php" method="post" id="cadastroProjeto" name="cadastroProjeto">
        <select name="slLinguagem" id="linguagem" required>
            <option value=""    hidden selected="true">Selecione uma Linguagem</option>
            <option value="1" name="C#">C#</option>
            <option value="2" name="PHP">PHP</option>
            <option value="3" name="C#">JAVA</option>
            <option value="4" name="C#">JAVA SCRIPT</option>
        </select>
        <input placeholder="Nome do projeto" id="nmProjeto" name="nmProjeto"  maxlength="99" required>
        <textarea placeholder="Descrição do projeto" name="descrProjeto" id="descrProjeto" cols="50" rows="4" maxlength="10000" required></textarea>
        <br>
        <br> 
        <button type="reset">Limpar formulário</button>
        <br>
        <br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>