<?php
include("../../../conection.php");
include("../../../environment.php");
include("../../../protect.php");
include ('../../../assets/includes/head.php');
include ('../../../assets/includes/sidebar.php');

$modulo = $_SESSION['id_mod'];

$empresas = $con->query("SELECT
emp.empresa_id,
emp.nome
FROM
tb_empresa emp;");?>

<style>.btn.btn-icon {line-height:35px!important;}</style>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h2>Lista de empresas</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>
        <div class="table-responsive">
        <a href="mp_cad_empresa.php?modulo=<?=$modulo?>" class="btn btn-secondary mb-2">Cadastrar</a>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Empresa</th>
                    <th COLSPAN="2" class="text-center">Ações</th>
                </tr>
                    <?php while($registros = $empresas->fetch_assoc()):
                                $id = $registros['empresa_id'];
                                $nome = $registros['nome'];?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $nome;?></td>
                    <td class="text-center"><a href='mp_upd_empresa.php?modulo=<?=$modulo;?>&id=<?=$id;?>'>
                      <i class="mdi mdi-pencil icon-sm"></i>
                    </a></td>
                    <td class="text-center"><a href='crud/del_empresa.php?modulo=<?=$modulo;?>&id=<?=$id;?>' onclick="return confirm('Tem certeza que deseja deletar esse registro?');">
                    <i class="mdi mdi-delete text-danger icon-sm"></i>
                    </a></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php include ('../../../assets/includes/footer.php'); ?>