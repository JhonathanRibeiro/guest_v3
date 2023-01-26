<?php
include("../../../conection.php");
include("../../../environment.php");
include("../../../protect.php");
include ('../../../assets/includes/head.php');
include ('../../../assets/includes/sidebar.php');

$acesso_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$modulo = $_SESSION['id_mod'];

$acesso = $con->query("SELECT
      nv.acesso_id,
      nv.nome
    FROM
      tb_nivel_de_acesso nv
    WHERE nv.acesso_id = $acesso_id;");?>

<style>.btn.btn-icon {line-height:35px!important;}</style>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h2>Atualizar nível de acesso</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Atualização de registro - níveis de acesso</h4>
    
      <form class="form-sample" method="POST" action="crud/upd_acesso.php">
        <div class="row">
          
        <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label">Nome nível de acesso</label>
              <?php while($registros = $acesso->fetch_assoc()): $nome = $registros['nome'];?>
                <input type="hidden" name="acesso_id" value="<?php echo $acesso_id; ?>">
                <input type="text" name="nome_acesso" class="form-control" value="<?php echo $nome;?>">
            <?php endwhile;?>
            </div>
        </div>

          <div class="col-md-12">
          <button type="submit" class="btn btn-primary mb-2">Atualizar</button>
          <a href="mp_read_niveis_acesso.php?modulo=<?php echo $modulo;?>" class="btn btn-secondary mb-2">Consultar</a>
          </div>
          </div>
      </form>
  </div>
</div>
</div>
</div>

<?php include ('../../../assets/includes/footer.php'); ?>