<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])){
    die("Acesso restrito, faça o login para acessar esta página. <p> <a href=\"login.php\">Acessar</a> </p>");
}
