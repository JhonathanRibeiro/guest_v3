<?php
include("../../../../conection.php");
include("../../../../environment.php");
include("../../../../protect.php");

$nome_usu  = filter_input(INPUT_POST, 'nome_usuario', FILTER_SANITIZE_SPECIAL_CHARS);
$senha  = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
$email     = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
// $acesso  = filter_input(INPUT_POST, 'acesso', FILTER_SANITIZE_NUMBER_INT);
$empresa  = filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_NUMBER_INT);
$id_usuario  = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);

$modulo = $_SESSION['id_mod'];

// $query = "SELECT
// tm.usuario_id,
// ts.acesso_id,
// tm.modulo_id,
// tm.acesso_id
// FROM
// tb_movimentacao_mod_usu tm
// JOIN tb_usuarios ts ON 
// tm.usuario_id = ts.usuario_id
// WHERE
// ts.usuario_id = '$id_usuario'
// AND ts.acesso_id = '$acesso'
// AND tm.modulo_id = '$modulo';";

// $result = mysqli_query($con,$query); 

// if ($result != false && $result->num_rows > 0) {
//     echo "";
// } else {
$con->query("UPDATE
tb_usuarios
SET
nome = '$nome_usu',
email = '$email',
senha = '$senha',
empresa_id = '$empresa'
WHERE usuario_id = '$id_usuario';"); 

$affected_rows = mysqli_affected_rows($con);
var_dump(mysqli_affected_rows($con));

if($affected_rows > 0) {
    $_SESSION["msg"] = 'Usuário atualizado com sucesso!';
    header("Location: ".SYSTEM."modules/manutencao_preventiva/usuario/mp_read_usu.php?modulo=".$modulo);
}