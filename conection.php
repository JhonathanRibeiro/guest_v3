<?php

$usuario = 'root';
$senha = '123456';
$database = 'gestaov3';
$host = 'localhost';

$con = new mysqli($host, $usuario, $senha, $database);

if($con->error) {
    die("Falha na conexão com o banco.");
}