<?php
include("../../../../conection.php");
include("../../../../environment.php");
include("../../../../protect.php");
include ('../../../../assets/message.php');

$empresa_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$modulo = $_SESSION['id_mod'];

$con->query("DELETE FROM tb_empresa WHERE empresa_id ='$empresa_id';");     

$affected_rows = mysqli_affected_rows($con);
var_dump(mysqli_affected_rows($con));

if($affected_rows > 0):
    $_SESSION["msg"] = 'Empresa excluída com sucesso!';
endif;

if(isset($_SESSION['msg'])) {
    unset($_SESSION['msg']); //apagando msg depois de exibir a mensagem
}
header("Location: ".SYSTEM."modules/manutencao_preventiva/empresa/mp_read_empresas.php?modulo=".$modulo);