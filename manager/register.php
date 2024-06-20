<?php 
include('conexao.php');
include('logs_gerais.php');


$name =  trim($_POST['name']);
$login = trim($_POST['userCadastro']);
$email = trim($_POST['email']);
$bDay = trim($_POST['bDay']);
$senha = trim(md5($_POST['password']));

$hoje = date('Y-m-d');
$date1 = new DateTime($bDay);
$date2 = new DateTime($hoje);
$interval = $date1->diff($date2);

// Acessa as propriedades do objeto DateInterval
$diffYears = $interval->y;


//verifica se o email digitado no cadastro ja está cadastrado
$stmt = $pdo->prepare ("select email from usuario where email = :email ");
$stmt->bindParam(':email', $email);
$stmt->execute();
//verifica quantas linhas o select retornou
$row = $stmt->rowCount();
//se a quandidade de linhas foi 1, ele redireciona pra pagina de acorodo com o tipo de usuario
if($row > 0){
    echo'emailErro';        
    exit();

}else{
    //verifica se o nome de usuario ainda está disponivel
    $stmt = $pdo->prepare ("select login from usuario where login = :login ");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    //verifica quantas linhas o select retornou
    $row = $stmt->rowCount();
    if($row > 0){
        echo 'userErro';        
        exit();

    }elseif($diffYears > 9.99){
        //insere os dados do novo registro
        $stmt = $pdo->prepare ("insert into usuario (id_tipo_user, nome, login, email, senha, id_bloqueio, data_nascimento, data_cadastro) 
        values ('2', :name, :login, :email, :senha, '1', :bDay, NOW());");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':bDay', $bDay);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();  

        $row = $stmt->rowCount();
        if($row == 1){
            //pega o id_user para podermos fazer o registro do LOG
            $stmt = $pdo->prepare ("select id_user, data_cadastro from usuario 
                                    where nome = :name
                                    and login = :login
                                    and senha = :senha
                                    and email = :email
                                    and data_nascimento = :bDay");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':bDay', $bDay);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute(); 
            $row_register = $stmt->fetch(PDO::FETCH_ASSOC);

            $arquivo = date('d-m-Y').'.log';
            $id_user = $row_register['id_user'];
            $data_log = $row_register['data_cadastro'];
            $register = $pdo->prepare("insert into logs_gerais (id_user, descr_log, data_log, id_nivel, arquivo) values (:id_user, 'O usúario se registrou no sistema.', :data_log, 2, :arquivo)");
            $register->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $register->bindParam(':data_log', $data_log);
            $register->bindParam(':arquivo', $arquivo);
            $register->execute();
            $row_log = $register->rowCount();
            
            if($row_log == 1){
                $log_geral->info('Usuário se cadastrou no sistema.', ['ID' => $id_user, 'IP' => $_SERVER["REMOTE_ADDR"]]);
                echo 'success';
                exit();                
            }
        }
    }else{
        echo 'dataErro';
        exit();
    }
}

?>


