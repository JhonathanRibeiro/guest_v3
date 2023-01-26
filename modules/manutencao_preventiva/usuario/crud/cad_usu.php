<?php
include("../../../../conection.php");
include("../../../../environment.php");
include("../../../../protect.php");
include ('../../../../assets/message.php');

$modulo = $_SESSION['id_mod'];
$nome_usu  = filter_input(INPUT_POST, 'nome_usuario', FILTER_SANITIZE_SPECIAL_CHARS);
$senha  = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
$email     = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$acesso  = filter_input(INPUT_POST, 'acesso', FILTER_SANITIZE_NUMBER_INT);
$empresa  = filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_NUMBER_INT);

$querySelect = $con->query("SELECT email FROM tb_usuarios");
$array_emails = [];

while($emails = $querySelect->fetch_assoc()):
    $emails_existentes = $emails['email'];
    array_push($array_emails, $emails_existentes);
endwhile;

if(in_array($email, $array_emails)):
  $_SESSION['msg'] = "Já existe um usuário cadastrado com este email!";
  header("Location: ".SYSTEM."modules/manutencao_preventiva/usuario/mp_cad_usu.php?modulo=".$modulo);
else:
  $queryInsert = $con->query("INSERT INTO tb_usuarios
  (nome,email,senha,acesso_id,empresa_id) VALUES ('$nome_usu','$email','$senha','$acesso','$empresa');");

  $affected_rows = mysqli_affected_rows($con);
  var_dump(mysqli_affected_rows($con));

  if($affected_rows > 0):
    $_SESSION["msg"] =  'Usuário cadastrado com sucesso!';
    header("Location: ".SYSTEM."modules/manutencao_preventiva/usuario/mp_read_usu.php?modulo=".$modulo);
 endif;
endif;