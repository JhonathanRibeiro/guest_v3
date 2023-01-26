<?php
include("../conection.php");
include("../environment.php");
include("../protect.php");

$modulo = filter_input(INPUT_POST, 'modulo',FILTER_SANITIZE_NUMBER_INT);
$privilegio = filter_input(INPUT_POST, 'privilegio',FILTER_SANITIZE_NUMBER_INT);
$nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);

$con->query("UPDATE
tb_privilegios_de_acesso
SET
modulo_id = '$modulo',
nome_privilegio = '$nome'
WHERE privilegio_id = '$privilegio';");

$affected_rows = mysqli_affected_rows($con);
var_dump(mysqli_affected_rows($con));

if($affected_rows > 0):
  $_SESSION["msg"] =  "<p class='center green-text'>".'Cadastro atualizado com sucesso!'."</p>";
  header("Location: ".SYSTEM."mp_read_niveis_acesso.php");
endif;