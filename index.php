<?php  
include("conection.php");
include("environment.php");
include("protect.php");

include ('assets/includes/head.php');
include ('assets/includes/sidebar_modules.php');

$id = $_SESSION['id'];
$sql_modulos = "SELECT
        tbm.modulo_id AS modulo,
        tbm.nome,
        tbm.pag_principal AS pag,
        tbm.slug,
        ms.bloqueio
        FROM
        tb_movimentacao_mod_usu ms
        JOIN tb_modulos tbm ON
        ms.modulo_id = tbm.modulo_id
        WHERE
        ms.usuario_id = $id AND ms.bloqueio = 0;";

$result = mysqli_query($con, $sql_modulos);

?>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h2>Módulos</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <?php while($row = mysqli_fetch_assoc($result)) {
          if(!isset($row["nome"])){
            echo "Você não está cadastrado em nenhum módulo ainda.";
          }
          ?>
          <div style="display:inline;">
          <a href="<?php echo SYSTEM."modules/".$row["slug"]."/".$row["pag"]?>.php?modulo=<?php echo $row["modulo"];?>">
              <button class="btn btn-outline-dark btn-icon-text">
                <i class="mdi mdi-alert-octagon mdi-36px"></i>
                <span class="d-inline-block text-left">
                  <?php echo $row["nome"]; ?>
                </span>
              </button>
          </a>
        </div>
      <?php } ?>
      </div>
    </div>
  </div>

</div>
</div>

<?php include ('assets/includes/footer.php'); ?>