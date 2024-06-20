<?php
if(isset($_SESSION['id_user'])){
    session_destroy();
}else{
    session_start();
}
ini_set('default_charset','UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/icons/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="src/normalize.css">
    <link rel="stylesheet" href="src/index.css">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/outros/jquery.min.js"></script>
    <script src="js/outros/html5shiv_3.7.3.min.js"></script>
    <script src="js/paginas/index.js"></script>
    <title>Portifólio</title>
</head>
<body>
    <div id="container">
        <div id="content">
            <div id="btnOpt" class="d-inline gap-2 d-flex">
                <button class="active btn btn-outline-primary w-50" id="login-form-link">Login</button>
                <button class="btn btn-outline-primary w-50" id="register-form-link">Register</button>
            </div><!-- FIM btnOpt-->
            <div id="itensContent">
                <i class="bi bi-person-circle" style="font-size: 60px; color: lightgrey;"></i>
                <form id="login-form" action="manager/login.php" method="post" role="form" style="display: block;">
                    <div id="sucesso" class="alert alert-success" role="alert" hidden>
                        Cadastro realizado com sucesso!
                    </div>
                    <div class="form-floating mt-3" style="color: gray;">
                        <input type="text" class="form-control" id="user" placeholder="User" name="user" required>
                        <label for="user">User</label>
                    </div>
                    <div class="form-floating mt-3" style="color: gray;">
                        <input type="password" class="form-control" id="senha" placeholder="Password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <button class="btn btn-lg btn-outline-primary mt-3 w-100" type="submit" id="login-button">Login</button>

                </form><!-- FIM login-form-->
                <form id="register-form" action="manager/register.php" method="post" role="form" style="display: none;">

                    <div id="erroEmail" class="alertError" hidden>
                        <i class="bi bi-exclamation-triangle me-1 " style="color: red;"></i> E-mail já cadastrado!
                    </div>
                    <div id="erroUser" class="alertError" hidden>
                        <i class="bi bi-exclamation-triangle me-1" style="color: red;"></i> Usuário já cadastrado!
                    </div>
                    <div id="erroData" class="alertError" hidden>
                        <i class="bi bi-exclamation-triangle me-1" style="color: red;"></i> Usuário deve ter mais de 10 anos!
                    </div>
                    <div class="form-floating mt-3" style="color: gray;">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                        <label for="name">Your Name</label>
                    </div>
                    <div class="form-floating mt-3" style="color: gray;">
                        <input type="text" class="form-control" id="userCadastro" name="userCadastro" placeholder="User" required>
                        <label for="user">User</label>
                    </div>
                    <div class="form-floating mt-3" style="color: gray;">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Your E-mail" required>
                        <label for="email">Your E-mail</label>
                    </div>
                    <div class="form-floating mt-3" style="color: gray;">
                        <input type="date" class="form-control" id="birth_date" name="bDay" placeholder="Birth Date" required>
                        <label for="birth_date">Birth Date</label>
                    </div>
                    <div class="form-floating mt-3" style="color: gray;">
                        <input onkeyup="validaSenha()" type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating mt-3" style="color: gray;">
                        <input onkeyup="validaSenha()" type="password" class="form-control" id="c_password" placeholder="Confirm Password" required>
                        <label for="c_password">Confirm Password</label>
                        <p id="confirmPass" style="color: white;"></p>
                    </div>
                    <button class="btn btn-lg btn-outline-primary mt-1 w-100 " type="submit" id="registerBt" disabled>Register</button> 
                </form><!-- FIM register-form-->
            </div><!-- FIM itensContent-->
        </div><!-- FIM content-->
    </div><!-- FIM container-->
</body>
</html>
