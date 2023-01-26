<?php
include("../../../../conection.php");
include("../../../../environment.php");
include("../../../../protect.php");
include ('../../../../assets/message.php');

$modulo = $_SESSION['id_mod'];
$acesso_id = filter_input(INPUT_POST, 'acesso_id', FILTER_SANITIZE_NUMBER_INT);
$nome  = filter_input(INPUT_POST, 'nome_acesso', FILTER_SANITIZE_SPECIAL_CHARS);

$con->query("UPDATE tb_nivel_de_acesso SET nome = '$nome' WHERE acesso_id = '$acesso_id';");

$affected_rows = mysqli_affected_rows($con);
var_dump(mysqli_affected_rows($con));

if($affected_rows > 0):
    $_SESSION["msg"] =  'Nível de acesso atualizado com sucesso!';
    header("Location: ".SYSTEM."modules/manutencao_preventiva/nivel_acesso/mp_read_niveis_acesso.php?modulo=".$modulo);
endif;