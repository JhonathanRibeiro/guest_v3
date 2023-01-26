<?php
include("../../../../conection.php");
include("../../../../environment.php");
include("../../../../protect.php");

$mod_id = $_SESSION['id_mod'];
$modulo  = filter_input(INPUT_POST, 'modulo', FILTER_SANITIZE_NUMBER_INT);
$usuario  = filter_input(INPUT_POST, 'usuario_id', FILTER_SANITIZE_NUMBER_INT);
$acesso  = filter_input(INPUT_POST, 'acesso_id', FILTER_SANITIZE_NUMBER_INT);
$bloqueio  = filter_input(INPUT_POST, 'bloqueio', FILTER_SANITIZE_NUMBER_INT);
$nome_acesso = filter_input(INPUT_POST, 'nome_acesso', FILTER_SANITIZE_SPECIAL_CHARS);

if ($bloqueio == null) {$bloqueio = 0;}

/*Verificando se o usuário e nível de acesso do mesmo já estão cadastrados no sistema.*/
$query = "SELECT
tm.modulo_id,
tm.usuario_id,
tm.acesso_id
FROM
tb_movimentacao_mod_usu tm
WHERE
tm.modulo_id = '$modulo'
AND tm.usuario_id = '$usuario';";

$result = mysqli_query($con,$query); 

if ($result != false && $result->num_rows > 0) {
    //fazer update no registro
    $con->query("UPDATE
	tb_movimentacao_mod_usu
SET
	acesso_id = '$acesso',
    bloqueio = '$bloqueio'
WHERE
	usuario_id = '$usuario' AND modulo_id = '$modulo';");
    
    $_SESSION["msg"] =  'Vínculo atualizado com sucesso!';
    header("Location: ".SYSTEM."modules/manutencao_preventiva/usuario/vincular_mod_usu.php?modulo=".$mod_id."&id=".$usuario);
} else {
    $con->query("INSERT INTO tb_movimentacao_mod_usu (modulo_id, usuario_id, acesso_id, bloqueio) VALUES ('$modulo','$usuario','$acesso','$bloqueio');");
    $affected_rows = mysqli_affected_rows($con);

    if($affected_rows > 0) {
        $_SESSION["msg"] =  'Novo vínculo cadastrado com sucesso!';
        header("Location: ".SYSTEM."modules/manutencao_preventiva/usuario/vincular_mod_usu.php?modulo=".$mod_id."&id=".$usuario);
    }
}