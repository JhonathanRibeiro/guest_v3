<?php  
include("../../conection.php");
include("../../environment.php");
include("../../protect.php");

include ('../../assets/includes/head.php');
include ('../../assets/includes/sidebar.php');

$id = $_SESSION['id'];

$query = "SELECT
        ts.nome FROM tb_usuarios ts WHERE usuario_id = $id;";

$result = mysqli_query($con, $query);

?>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h2>Bem vindo,</h2>
          <?php while($row = mysqli_fetch_assoc($result)) {?>
            <p class="mb-md-0"><?php echo $row["nome"];?></p>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
  <div class="content-wrapper">
  <div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
              <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
              <div class=""></div>
            </div>
          </div>
          <h4 class="card-title">Line chart</h4>
          <canvas id="lineChart" width="457" height="228" style="display: block; width: 457px; height: 228px;"
            class="chartjs-render-monitor"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
              <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
              <div class=""></div>
            </div>
          </div>
          <h4 class="card-title">Bar chart</h4>
          <canvas id="barChart" style="display: block; width: 457px; height: 228px;" width="457" height="228"
            class="chartjs-render-monitor"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
              <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
              <div class=""></div>
            </div>
          </div>
          <h4 class="card-title">Area chart</h4>
          <canvas id="areaChart" width="457" height="228" style="display: block; width: 457px; height: 228px;"
            class="chartjs-render-monitor"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
              <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
              <div class=""></div>
            </div>
          </div>
          <h4 class="card-title">Doughnut chart</h4>
          <canvas id="doughnutChart" width="457" height="228" style="display: block; width: 457px; height: 228px;"
            class="chartjs-render-monitor"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
              <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
              <div class=""></div>
            </div>
          </div>
          <h4 class="card-title">Pie chart</h4>
          <canvas id="pieChart" width="457" height="228" style="display: block; width: 457px; height: 228px;"
            class="chartjs-render-monitor"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
              <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
              <div class=""></div>
            </div>
          </div>
          <h4 class="card-title">Scatter chart</h4>
          <canvas id="scatterChart" width="457" height="228" style="display: block; width: 457px; height: 228px;"
            class="chartjs-render-monitor"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

<?php include ('../../assets/includes/footer.php'); ?>