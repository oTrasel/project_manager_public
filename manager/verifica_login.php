<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Expires: Sat, 01 Jan 2000 00:00:00 GMT');

if(!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') {
    session_destroy();
    header('Location: index.php?login=erro');
}


?>