<?php
if ($_SESSION ) {
    session_start();
}

require_once __DIR__ . '/../controll/LoginControll.php';

$loginControll = new LoginControll();

if(isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado']===true){
    if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] ===true){
        header ("Location ../../adminView.php");
    }else{
        header ("Location: ../../cliente.php");
    }
    exit;
}
