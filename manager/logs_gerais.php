<?php
define('BASE_PATH', __DIR__); // Caminho base do projeto
define('LOGS_PATH', BASE_PATH . '/../logs_gerais');

date_default_timezone_set('America/Sao_Paulo'); // Hora e data local

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

//carrega o composer
require __DIR__ . '/../vendor/autoload.php';
//pega a data atual para nomear o log e criar um arquivo por dia!
$hoje = date('d-m-Y');

// cria o logger
$log_geral = new Logger('name');

// Utilizar StreamHandler para salvar os logs no arquivo
$log_geral->pushHandler(new StreamHandler(LOGS_PATH.'/'.$hoje.'.log', Logger::INFO));


?>