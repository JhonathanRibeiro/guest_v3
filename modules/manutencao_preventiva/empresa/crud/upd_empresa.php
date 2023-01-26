<?php
include("../../../../conection.php");
include("../../../../environment.php");
include("../../../../protect.php");

$empresa_id = filter_input(INPUT_POST, 'empresa_id', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, 'nome_empresa', FILTER_SANITIZE_SPECIAL_CHARS);
$modulo = $_SESSION['id_mod'];

$con->query("UPDATE tb_empresa SET nome = '$nome' WHERE empresa_id = '$empresa_id';");     

$affected_rows = mysqli_affected_rows($con);
var_dump(mysqli_affected_rows($con));

if($affected_rows > 0):
    $_SESSION["msg"] = 'Empresa atualizada com sucesso!';
endif;

header("Location: ".SYSTEM."modules/manutencao_preventiva/empresa/mp_read_empresas.php?modulo=".$modulo);