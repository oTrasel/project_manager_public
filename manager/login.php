<?php 
session_start();
include('conexao.php');
include('logs_gerais.php');

$arquivo = date('d-m-Y').'.log';

$login =  $_POST['user'];
$senha = md5($_POST['password']);

$stmt = $pdo->prepare ("select login, nome, id_tipo_user, id_user, id_bloqueio from usuario where login = :login and senha = :senha");
$stmt->bindParam(':login', $login);
$stmt->bindParam(':senha', $senha);
$stmt->execute();
//verifica quantas linhas o select retornou
$row = $stmt->fetch(PDO::FETCH_ASSOC); // Obter a primeira linha do resultado como um array associativo

if ($row !== false) {
    if ($row['id_bloqueio'] == '2'){
        
        $projeto = $pdo->prepare("select * from projeto where id_user = :id_user");
        $projeto->bindParam(':id_user', $row['id_user'], PDO::PARAM_INT);
        $projeto->execute();
        $rows_prj = $projeto->fetchAll(PDO::FETCH_ASSOC);
    
        if ($rows_prj !== false) {
            $_SESSION['projetos'] = $rows_prj;
        }
    
        if($row['id_tipo_user'] == 1){
            $_SESSION['adm'] = true;
        }else{
            $_SESSION['adm'] = false;
        }
        $_SESSION['autenticado'] = 'SIM';
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['login'] = $row['login'];
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['id_tipo_user'] = $row['id_tipo_user'];
        // Redirecionar para a página desejada com as variáveis armazenadas
        echo "success";
        $stmt = $pdo->prepare ("insert into logs_login (id_user, descr_log, data_login, id_nivel, arquivo) values (:id_user, 'Login realizado', NOW(), 2, :arquivo)");
        $stmt->bindParam(':id_user', $row['id_user']);
        $stmt->bindParam(':arquivo', $arquivo);
        $stmt->execute();
        $log_geral->info('Login realizado.', ['ID' => $row['id_user'], 'IP' => $_SERVER["REMOTE_ADDR"]]);
        exit();

    }else if($row['id_bloqueio'] == '1'){
        session_destroy();
        echo "errorBlock";
        //gera os logs
        $stmt = $pdo->prepare ("insert into logs_gerais (id_user, descr_log, data_log, id_nivel, arquivo) values (:id_user, 'Usuário bloqueado tentou realizar login.', NOW(), 2, :arquivo)");
        $stmt->bindParam(':id_user', $row['id_user']);
        $stmt->bindParam(':arquivo', $arquivo);
        $stmt->execute();
        $log_geral->info('Usuário bloqueado tentou realizar login.', ['ID' => $row['id_user'], 'IP' => $_SERVER["REMOTE_ADDR"]]);

    }else{
        session_destroy();
        echo "errorBan";
        $stmt = $pdo->prepare ("insert into logs_gerais (id_user, descr_log, data_log, id_nivel, arquivo) values (:id_user, 'Usuário banido tentou realizar login.', NOW(), 4, :arquivo)");
        $stmt->bindParam(':id_user', $row['id_user']);
        $stmt->bindParam(':arquivo', $arquivo);
        $stmt->execute();
        $log_geral->warning('Usuário banido tentou realizar login.', ['ID' => $row['id_user'], 'IP' => $_SERVER["REMOTE_ADDR"]]);
    }

}else{
    $log_geral->error('Tentativa de login realizada.', ['Login Utilizado' => $login, 'IP' => $_SERVER["REMOTE_ADDR"]]);
    session_destroy();
    echo "erro";
}
    
   

?>