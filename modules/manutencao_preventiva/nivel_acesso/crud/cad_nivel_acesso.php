<?php
include("../../../../conection.php");
include("../../../../environment.php");
include("../../../../protect.php");
include ('../../../../assets/message.php');

$modulo = $_SESSION['id_mod'];
$nome  = filter_input(INPUT_POST, 'nome_acesso', FILTER_SANITIZE_SPECIAL_CHARS);
$con->query("INSERT INTO tb_nivel_de_acesso (nome) VALUES ('$nome');");

$affected_rows = mysqli_affected_rows($con);
var_dump(mysqli_affected_rows($con));

if($affected_rows > 0):
    $_SESSION["msg"] =  'Nível de acesso cadastrado com sucesso!';
    header("Location: ".SYSTEM."modules/manutencao_preventiva/nivel_acesso/mp_read_niveis_acesso.php?modulo=".$modulo);
endif;