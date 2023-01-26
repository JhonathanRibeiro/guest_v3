<?php
include("../conection.php");
include("../environment.php");
include("../protect.php");

$nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
$privilegio = filter_input(INPUT_POST, 'privilegio', FILTER_SANITIZE_NUMBER_INT);
$empresa = filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_NUMBER_INT);

$querySelect = $con->query("SELECT email FROM tb_usuarios");
$array_emails = [];

while($emails = $querySelect->fetch_assoc()):
    $emails_existentes = $emails['email'];
    array_push($array_emails, $emails_existentes);
endwhile;

if(in_array($email, $array_emails)):
  $_SESSION["msg"] = "<p class='center red-text'>".'Já existe um usuário cadastrado com este email!'."</p>";
  header("Location: ".SYSTEM."cad_usuarios.php");
else:
  $con->query("INSERT INTO tb_usuarios (nome, email, senha, privilegio_id, empresa_id) VALUES ('$nome','$email','$senha','$privilegio','$empresa');");

  $affected_rows = mysqli_affected_rows($con);
  var_dump(mysqli_affected_rows($con));

  if($affected_rows > 0):
    $_SESSION["msg"] =  "<p class='center green-text'>".'Usuário cadastrado com sucesso!'."</p>";
    header("Location: ".SYSTEM."cad_usuarios.php");
 endif;
endif;
