<?php
include("../../../conection.php");
include("../../../environment.php");
include("../../../protect.php");
include ('../../../assets/includes/head.php');
include ('../../../assets/includes/sidebar.php');
include ('../../../assets/message.php');

$modulo = $_SESSION['id_mod'];
$niveis = $con->query("SELECT nv.acesso_id, nv.nome FROM tb_nivel_de_acesso nv;");

if(isset($_SESSION['msg'])) {
  showMsg($_SESSION['msg']);
  unset($_SESSION['msg']); //apagando msg depois de exibir a mensagem
}?>

<style>.btn.btn-icon {line-height:35px!important;}</style>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h2>Lista de níveis de acesso</h2>
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
        <a href="mp_cad_acesso.php?modulo=<?=$modulo?>" class="btn btn-secondary mb-2">Cadastrar</a>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Empresa</th>
                    <th COLSPAN="2" style="text-align:center;margin-left:-10px;">Ações</th>
                    <th></th>
                </tr>
                    <?php while($registros = $niveis->fetch_assoc()):
                                $id = $registros['acesso_id'];
                                $nome = $registros['nome'];?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $nome;?></td>
                    <td><a href='mp_upd_nivel_acesso.php?modulo=<?=$modulo;?>&id=<?=$id;?>'>
                      <i class="mdi mdi-lead-pencil text-warning icon-sm"></i>
                    </a></td>
                    <td><a href='crud/del_nivel_acesso.php?modulo=<?=$modulo;?>&id=<?=$id;?>' onclick="return confirm('Tem certeza que deseja deletar esse registro?');">
                      <i class="mdi mdi-delete text-danger icon-sm"></i>
                    </a></td>
                    <td>
                      <a href="config_pages.php?modulo=<?=$modulo;?>">
                        <i class="mdi mdi-sitemap text-primary icon-sm"></i>
                      </a>
                    </td>
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