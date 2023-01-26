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

$usuarios = $con->query("SELECT
ts.usuario_id,
ts.nome,
ts.email,
ts.senha,
ts.acesso_id,
ts.empresa_id
FROM
tb_usuarios ts
WHERE ts.usuario_id = '$usu_id';");

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
# ===================================================================================
$acessos = $con->query("SELECT nv.acesso_id, nv.nome FROM tb_nivel_de_acesso nv;");
# ===================================================================================
$empresas = $con->query("SELECT te.empresa_id, te.nome FROM tb_empresa te;");
# ===================================================================================
if(isset($_SESSION['msg'])) {
  showMsg($_SESSION['msg']);
  unset($_SESSION['msg']);
}
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
      <h4 class="card-title">Atualização de cadastro</h4>
      <form class="form-sample" method="POST" action="crud/upd_usu.php">
      <?php while($row = $usuarios->fetch_assoc()): 
                        $usuario_id = $row['usuario_id'];
                        $nome = $row['nome'];
                        $email = $row['email'];
                        $senha = $row['senha'];
                        $acesso_id = $row['acesso_id'];
                        $empresa_id = $row['empresa_id'];?>
      <div class="row">
        <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label">Nome usuário</label>
                <input type="hidden" name="id_usuario" class="form-control" value="<?php echo $usu_id;?>">
                <input type="text" name="nome_usuario" class="form-control" value="<?php echo $nome;?>">
            </div>
        </div>
       
        <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label">E-mail</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email;?>">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label">Empresa</label>
              <select name="empresa" class="form-control">
                    <?php while($row = $empresas->fetch_assoc()): 
                        $empresa = $row['empresa_id'];
                        $nome = $row['nome'];?>
                      <option value="<?php echo $empresa;?>" <?=($empresa_id == $empresa)?'selected':''?>><?php echo $nome;?></option>
                    <?php endwhile;?>
              </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label">Senha</label>
                <input type="text" name="senha" class="form-control" value="<?php echo $senha;?>">
            </div>
        </div>

        <?php endwhile;?>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary mb-2">Atualizar</button>
            <a href="mp_read_usu.php?modulo=<?php echo $modulo;?>" class="btn btn-secondary mb-2">Consultar</a>
        </div>
        </div>
      </form>
  </div>
</div>
</div>
</div>

<?php include ('../../../assets/includes/footer.php'); ?>