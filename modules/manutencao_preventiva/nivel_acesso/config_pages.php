<?php
include("../../../conection.php");
include("../../../environment.php");
include("../../../protect.php");
include ('../../../assets/includes/head.php');
include ('../../../assets/includes/sidebar.php');
include ('../../../assets/message.php');

$modulo = $_SESSION['id_mod'];
$niveis = $con->query("SELECT
tt.tela_id,
tt.nome,
pt.consultar, 
pt.incluir,
pt.editar,
pt.excluir
FROM
tb_permissao_telas pt
JOIN tb_telas tt ON pt.tela_id = tt.tela_id;");

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
          <h2>Permissões de acesso</h2>
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
          <form id="form" action="crud/cad_permissao_telas.php" method="POST">
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Tela</th>
                    <th>Consultar</th>
                    <th>Incluir</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                    <?php while($registros = $niveis->fetch_assoc()):
                                $tela_id = $registros['tela_id'];
                                $nome = $registros['nome'];
                                $consultar = $registros['consultar'];
                                $incluir = $registros['incluir'];
                                $editar = $registros['editar'];
                                $excluir = $registros['excluir'];?>
                <tr>
                    <input type="hidden" name="tamanho_array" value="<?php echo count($registros);?>">
                    <td><?php echo $tela_id;?></td>
                    <td><?php echo $nome;?></td>
                    <input type="hidden" name="tela_id[]" value="<?php echo $tela_id; ?>">
                    <input type="hidden" name="nome_tela[]" value="<?php echo $nome; ?>">
                    <td>
                      <input type="checkbox" class="ck" name="consultar[]" value="1">
                    </td>
                    
                    <td>
                      <input type="checkbox" class="ck" name="incluir[]" value="1">
                    </td>
                    
                    <td>
                      <input type="checkbox" class="ck" name="editar[]" value="1">
                    </td>
                    
                    <td>
                      <input type="checkbox" class="ck" name="excluir[]" value="1">
                    </td>

                </tr>
                <?php endwhile; ?>
            </table>
            <input type="submit" value="Salvar">
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- <script src="<?php #echo SYSTEM;?>assets/js/jquery-3.6.3.min.js"></script>
<script src="<?php #echo SYSTEM;?>assets/js/form_config_pages.js"></script> -->
<?php include ('../../../assets/includes/footer.php'); ?>