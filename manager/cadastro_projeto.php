<?php
include('verifica_login.php');
include('conexao.php');

ini_set('default_charset','UTF-8');

if(isset($_SESSION['nome'])){
  $nome = substr($_SESSION['nome'], 0, strpos($_SESSION['nome'], ' '));
}


if(isset($_SESSION['id_user'])){
    $id_user =  $_SESSION['id_user'];
}else{
    session_destroy();
    echo "<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Erro de conexão, por favor faça login novamente!')
    window.location.href='../index.php';
    </SCRIPT>";
}

$nmProjeto = $_POST['nmProjeto'];
$idLinguagem = $_POST['slLinguagem'];
$descrProjeto = $_POST['descrProjeto'];
$status = 4;

$stmt = $pdo->prepare ("insert into projeto (id_user, nome_projeto, desc_projeto, data_inicio_projeto, id_status, id_linguagem)
                                     values (:id_user, :nmProjeto, :descrProjeto, NOW(), :status, :idLinguagem)");
$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
$stmt->bindParam(':nmProjeto', $nmProjeto);
$stmt->bindParam(':idLinguagem', $idLinguagem, PDO::PARAM_INT);
$stmt->bindParam(':descrProjeto', $descrProjeto);
$stmt->bindParam(':status', $status, PDO::PARAM_INT);
$stmt->execute();  

$row = $stmt->rowCount();
if($row == 1){
    if(isset($_SESSION['projetos'])){
        unset($_SESSION['projetos']);
        $projeto = $pdo->prepare("select * from projeto where id_user = :id_user");
        $projeto->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $projeto->execute();
        $rows_prj = $projeto->fetchAll(PDO::FETCH_ASSOC);
        if ($rows_prj !== false) {
            $_SESSION['projetos'] = $rows_prj;
            echo 'success';
            exit();
        }
    }else{
        $projeto = $pdo->prepare("select * from projeto where id_user = :id_user");
        $projeto->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $projeto->execute();
        $rows_prj = $projeto->fetchAll(PDO::FETCH_ASSOC);
        if ($rows_prj !== false) {
            $_SESSION['projetos'] = $rows_prj;
            echo 'success';
            exit();
        } 
    }
}else{
    echo 'error';
    session_destroy();
}
?>
