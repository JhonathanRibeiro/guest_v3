<?php
include("../conection.php");
include("../environment.php");
include("../protect.php");

$nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
$empresa = filter_input(INPUT_POST, 'empresa',FILTER_SANITIZE_NUMBER_INT);
$privilegio = filter_input(INPUT_POST, 'privilegio',FILTER_SANITIZE_NUMBER_INT);
$usuario_id = filter_input(INPUT_POST, 'usuario_id',FILTER_SANITIZE_NUMBER_INT);

$con->query("UPDATE
tb_usuarios 
SET
nome = '$nome',
email = '$email',
senha = '$senha',
privilegio_id = '$privilegio',
empresa_id = '$empresa'
WHERE usuario_id = '$usuario_id';");

$affected_rows = mysqli_affected_rows($con);
var_dump(mysqli_affected_rows($con));

if($affected_rows > 0):
  $_SESSION["msg"] =  "<p class='center green-text'>".'Usuário atualizado com sucesso!'."</p>";
  header("Location: ".SYSTEM."read_usuarios.php");
endif;