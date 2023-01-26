<?php 
include("../../../conection.php");
include("../../../environment.php");
include("../../../protect.php");

include ('../../../assets/includes/head.php');
include ('../../../assets/includes/sidebar.php');
include ('../../../assets/message.php');

# =================================================
$usu_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$modulo = $_SESSION['id_mod'];

$usuarios = $con->query("SELECT ts.acesso_id FROM tb_usuarios ts WHERE ts.usuario_id = '$usu_id';");

$acesso = $con->query("SELECT
ts.usuario_id,
ts.nome,
ts.acesso_id acesso_usu,
nv.nome AS nome_acesso
FROM
tb_usuarios ts
JOIN tb_nivel_de_acesso nv ON
nv.acesso_id = ts.acesso_id 
WHERE ts.usuario_id = '$usu_id';");
# =================================================
$modulos = $con->query("SELECT
tm.modulo_id,
tm.nome
FROM
tb_modulos tm;");
# =================================================
$queryModulos = "SELECT
    tm.modulo_id,
    tm.nome
FROM
    tb_modulos tm
WHERE tm.modulo_id = $modulo;";

$res_mod = mysqli_query($con,$queryModulos);
$arrayModulos = array();

if ($res_mod != false && $res_mod->num_rows > 0) {
    while($row = $res_mod->fetch_assoc()) {
      $arrayModulos[] = array(
          'nome' => $row["nome"]
        );
    }
}

if(isset($_SESSION['msg'])) {
  showMsg($_SESSION['msg']);
  unset($_SESSION['msg']);
}
# =================================================
$acessos = $con->query("SELECT nv.acesso_id, nv.nome FROM tb_nivel_de_acesso nv;");


$queryMovUsu = $con->query("SELECT
mv.modulo_id,
md.nome AS modulo,
mv.usuario_id,
ts.nome AS usuario,
mv.acesso_id,
nv.nome AS nivel,
mv.bloqueio
FROM
tb_movimentacao_mod_usu mv
JOIN tb_usuarios ts ON
mv.usuario_id = ts.usuario_id
JOIN tb_modulos md ON
md.modulo_id = mv.modulo_id
JOIN tb_nivel_de_acesso nv ON 
nv.acesso_id = mv.acesso_id
WHERE mv.usuario_id = '$usu_id';");
?>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
            <?php foreach($arrayModulos as $row) {?>
                <h2><?php echo $row["nome"];?></h2>
            <?php }?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Vinculo de usuário x modulos</h4>
      <form class="form-sample" method="POST" action="crud/vinc_usu.php">
        <div class="row">
          
          <?php while($registros = $acesso->fetch_assoc()): 
              $nome = $registros['nome'];
              $acess_usu = $registros['acesso_usu'];
              ?>
              <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-form-label">Usuário</label>
                    <input type="hidden" name="usuario_id" value="<?php echo $registros["usuario_id"]; ?>">
                    <input type="text" disabled class="form-control" value="<?php echo $registros["nome"];?>">
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-form-label">Nível de acesso</label>
                  <select name="acesso_id" class="form-control">
                        <?php while($row = $acessos->fetch_assoc()): 
                            $acess_id = $row['acesso_id'];
                            $nome = $row['nome'];?>
                          <option value="<?php echo $acess_id;?>" <?=($acess_id == $acess_usu)?'selected':''?> ><?php echo $nome;?></option>
                        <?php endwhile;?>
                  </select>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-form-label">Modulos</label>
                  <select name="modulo" class="form-control">
                      <?php while($row = $modulos->fetch_assoc()): 
                          $mod_id = $row['modulo_id'];
                          $nome = $row['nome'];?>
                          <option value="<?php echo $mod_id;?>"><?php echo $nome;?></option>
                      <?php endwhile;?>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                <br><br><br>
                  <span class="col-form-label">Bloquear acesso &nbsp;</span> 
                  
                    <input type="checkbox" value="1" name="bloqueio">
                </div>
              </div>
              
          <?php endwhile;?>
          <div class="col-md-12">
          <button type="submit" class="btn btn-primary mb-2">Cadastrar</button>
          <a href="mp_read_usu.php?modulo=<?php echo $modulo;?>" class="btn btn-secondary mb-2">Consultar</a>
          </div>
          </div>
      </form>
  </div>
</div>
</div>
</div>

<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Privilégios de acesso por módulo</h4>
        <table class="table table-striped">
          <tr>
            <th>Modulo</th>
            <th>Usuario</th>
            <th>Nivel</th>
            <th>Bloqueado?</th>
          </tr>
          <?php while($row = $queryMovUsu->fetch_assoc()): 
                          $modulo = $row['modulo'];
                          $usuario = $row['usuario'];
                          $nivel = $row['nivel'];
                          $bloqueio = $row['bloqueio'];
                          ?>
                        <tr>
                          <td><?php echo $modulo;?></td>
                          <td><?php echo $usuario;?></td>
                          <td><?php echo $nivel;?></td>
                          <td><?=($bloqueio == 0)?'Não':'Sim'?></td>
                        </tr>
          <?php endwhile;?>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include ('../../../assets/includes/footer.php'); ?>