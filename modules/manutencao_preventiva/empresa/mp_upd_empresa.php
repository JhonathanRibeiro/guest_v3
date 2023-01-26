<?php
include("../../../conection.php");
include("../../../environment.php");
include("../../../protect.php");
include ('../../../assets/includes/head.php');
include ('../../../assets/includes/sidebar.php');

$empresa_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$modulo = $_SESSION['id_mod'];

$empresas = $con->query("SELECT
emp.empresa_id,
emp.nome
FROM
tb_empresa emp
WHERE emp.empresa_id = $empresa_id;");
?>

<style>.btn.btn-icon {line-height:35px!important;}</style>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h2>Atualizar empresa</h2>
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
    
      <form class="form-sample" method="POST" action="crud/upd_empresa.php">
        <div class="row">
          
        <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label">Nome empresa</label>
              <?php while($registros = $empresas->fetch_assoc()): $nome = $registros['nome'];?>
                <input type="hidden" name="empresa_id" value="<?php echo $empresa_id; ?>">
                <input type="text" name="nome_empresa" class="form-control" value="<?php echo $nome;?>">
            <?php endwhile;?>
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