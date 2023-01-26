<?php

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$t = filter_input(INPUT_POST, 'tamanho_array',FILTER_DEFAULT);

$newArray = $data;
$res = [];

$res = array_merge(array($newArray['tela_id']), array($newArray['nome_tela']), array($newArray['consultar']), array($newArray['incluir']), array($newArray['editar']), array($newArray['excluir']));

print_r($res);


// tela_id
// nome_tela
// consultar
// incluir
// editar
// excluir

// $newArray = $data;
// $i = 0;

// while($i < intval($t)) {
// foreach($newArray as $v){   
    
//     $id =  isset($newArray['tela_id'][$i]) ? $newArray['tela_id'][$i] : null;
//     $privilegio =  isset($newArray['privilegio_id'][$i]) ? $newArray['privilegio_id'][$i] : null;
//     $modulo =  isset($newArray['modulo_id'][$i]) ? $newArray['modulo_id'][$i] : null;
//     $permissao =  isset($newArray['permissoes'][$i]) ? $newArray['permissoes'][$i] : null;

//     $con->query("UPDATE
//             tb_permissoes_telas
//         SET
//             tela_id = '$id',
//             modulo_id = '$modulo',
//             privilegio_id = '$privilegio',
//             permissao = '$permissao'
//         WHERE
//             privilegio_id = '$privilegio' AND tela_id = '$id';");     

//     $affected_rows = mysqli_affected_rows($con);
//     var_dump(mysqli_affected_rows($con));

//     if($affected_rows > 0):
//         $_SESSION["msg"] =  "<p class='center green-text'>".'Permissões atualizadas com sucesso!'."</p>";
//     endif;
    
//     $i++;
// }
// // echo "<pre>";
// // print_r($newArray);
// // echo "</pre>";
// }