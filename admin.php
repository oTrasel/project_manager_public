<?php
include('manager/verifica_login.php');
include('manager/conexao.php');
include('manager/logs_gerais.php');
ini_set('default_charset','UTF-8');

//verifica se o user é admin caso contrario executa o if abaixo.
if($_SESSION['adm'] == false){

    
    //atualiza o status do user para banido.
    $logs = $pdo->prepare("update usuario set id_bloqueio = 3 where id_user = :id_user");
    $logs->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_INT);
    $logs->execute();

    //cria o log no banco de dados
    $arquivo = date('d-m-Y').'.log';
    $logs = $pdo->prepare("insert into logs_gerais (id_user, descr_log, data_log, id_nivel, arquivo) values (:id_user, 'Usúario banido por tentar acessar página de administrador sem permissão.', NOW(), 4, :arquivo)");
    $logs->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_INT);
    $logs->bindParam(':arquivo', $arquivo);
    $logs->execute();

    //cria o log no no arquivo de log
    $log_geral->warning('Usúario banido por tentar acessar página de administrador sem permissão.', ['ID' => $_SESSION['id_user'], 'IP' => $_SERVER["REMOTE_ADDR"]]);

    //redireciona para a index.
    header('Location: index.php');
    session_destroy();
    exit();
}

?>