<?php
include("../../../../conection.php");
include("../../../../environment.php");
include("../../../../protect.php");
include ('../../../../assets/message.php');

$modulo = $_SESSION['id_mod'];
$nome  = filter_input(INPUT_POST, 'nome_empresa', FILTER_SANITIZE_SPECIAL_CHARS);
$con->query("INSERT INTO tb_empresa (nome) VALUES ('$nome');");

$affected_rows = mysqli_affected_rows($con);
var_dump(mysqli_affected_rows($con));

if($affected_rows > 0):
    $_SESSION["msg"] =  'Empresa cadastrada com sucesso!';
    
    if(isset($_SESSION['msg'])) {
        showMsg($_SESSION['msg']);
        unset($_SESSION['msg']); //apagando msg depois de exibir a mensagem
        header("Location: ".SYSTEM."modules/manutencao_preventiva/empresa/mp_cad_empresa.php?modulo=".$modulo);
    }

endif;