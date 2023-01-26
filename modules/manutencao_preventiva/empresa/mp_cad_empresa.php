<?php 
include("../../../conection.php");
include("../../../environment.php");
include("../../../protect.php");

include ('../../../assets/includes/head.php');
include ('../../../assets/includes/sidebar.php');
include ('../../../assets/message.php');

# =================================================
$modulo = $_SESSION['id_mod'];

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
  unset($_SESSION['msg']); //apagando msg depois de exibir a mensagem
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
      <h4 class="card-title">Cadastro de empresas</h4>
    
      <form class="form-sample" method="POST" action="crud/cad_empresa.php">
        <div class="row">
          
        <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label">Nome empresa</label>
                <input type="text" name="nome_empresa" class="form-control">
            </div>
        </div>

          <div class="col-md-12">
          <button type="submit" class="btn btn-primary mb-2">Cadastrar</button>
          <a href="mp_read_empresas.php?modulo=<?php echo $modulo;?>" class="btn btn-secondary mb-2">Consultar</a>
          </div>
          </div>
      </form>
  </div>
</div>
</div>
</div>

<?php include ('../../../assets/includes/footer.php'); ?>