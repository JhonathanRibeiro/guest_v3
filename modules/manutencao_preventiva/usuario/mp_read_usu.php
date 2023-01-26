<?php
include("../../../conection.php");
include("../../../environment.php");
include("../../../protect.php");
include ('../../../assets/includes/head.php');
include ('../../../assets/includes/sidebar.php');
include ('../../../assets/message.php');

$modulo = $_SESSION['id_mod'];

$usuarios = $con->query("SELECT
ts.usuario_id,
ts.nome,
ts.email,
nv.nome AS nivel_acesso,
tm.nome AS empresa
FROM
tb_usuarios ts
JOIN tb_empresa tm ON
tm.empresa_id = ts.empresa_id
JOIN tb_nivel_de_acesso nv ON
nv.acesso_id = ts.acesso_id;");

if(isset($_SESSION['msg'])) {
  showMsg($_SESSION['msg']);
  unset($_SESSION['msg']);
}
?>

<style>.btn.btn-icon {line-height:35px!important;}</style>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h2>Lista usuários</h2>
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
        <a href="mp_cad_usu.php?modulo=<?=$modulo?>" class="btn btn-secondary mb-2">Cadastrar</a>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <!-- <th>Nível acesso</th> -->
                    <th>Empresa</th>
                    <th COLSPAN="3" style="text-align:center;">Ações</th>
                </tr>
                    <?php while($registros = $usuarios->fetch_assoc()):
                                $id = $registros['usuario_id'];
                                $nome = $registros['nome'];
                                $email = $registros['email'];
                                $nivel = $registros['nivel_acesso'];
                                $empresa = $registros['empresa'];?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $nome;?></td>
                    <td><?php echo $email;?></td>
                    <td><?php echo $empresa;?></td>
                    <td><a href='mp_upd_usu.php?modulo=<?=$modulo;?>&id=<?=$id;?>'>
                      <i class="mdi mdi-lead-pencil text-warning icon-sm"></i>
                    </a></td>
                    <td><a href='crud/del_usu.php?modulo=<?=$modulo;?>&id=<?=$id;?>' onclick="return confirm('Tem certeza que deseja deletar esse registro?');">
                    <i class="mdi mdi-delete text-danger icon-sm"></i>
                  </a></td>
                  <td><a href="vincular_mod_usu.php?modulo=<?=$modulo;?>&id=<?=$id;?>">
                    <i class="mdi mdi-link-variant text-primary icon-sm"></i>
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