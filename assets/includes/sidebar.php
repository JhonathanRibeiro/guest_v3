<?php 
$_SESSION['id_mod'] = filter_input(INPUT_GET, 'modulo', FILTER_SANITIZE_NUMBER_INT);

$modulo = $_SESSION['id_mod'];

$sql_modulos = "SELECT
tp.permissao_id,
tp.tela_id,
tt.modulo_id AS modulo,
tt.nome,
tt.slug AS pagina,
tm.slug AS diretorio,
tp.consultar
FROM
tb_permissao_telas tp
JOIN tb_telas tt ON
tp.tela_id = tt.tela_id
JOIN tb_modulos tm ON 
tt.modulo_id = tm.modulo_id 
WHERE
tt.modulo_id = $modulo;";

$result = mysqli_query($con,$sql_modulos);
# ========================================================
# Convertendo resultado da consulta em array
# ========================================================
$newArray = array();
if ($result != false && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	$newArray[] = array(
       'tela_id' => $row["tela_id"],
       'modulo_id' => $row["modulo"],
       'nome_tela' => $row["nome"],
       'pagina' => $row["pagina"],
       'diretorio' => $row["diretorio"],
       'consultar' => $row["consultar"]);
    }
  }
?>
<div class="container-scroller">
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex justify-content-center">
    <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">    
      <a class="navbar-brand brand-logo" href="#"><img src="<?php echo SYSTEM;?>assets/images/logo.png" alt="logo"/></a>
      <a class="navbar-brand brand-logo-mini" href="#"><img src="<?php echo SYSTEM;?>assets/images/logo-mini.svg" alt="logo"/></a>
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-sort-variant"></span>
      </button>
    </div>  
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <ul class="navbar-nav mr-lg-4 w-100">
      <li class="nav-item nav-search d-none d-lg-block w-100">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="search">
              <i class="mdi mdi-magnify"></i>
            </span>
          </div>
          <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
        </div>
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown me-1">
        <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
          <i class="mdi mdi-message-text mx-0"></i>
          <span class="count"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
          <a class="dropdown-item">
            <div class="item-thumbnail">
                <img src="<?php echo SYSTEM;?>assets/images/faces/face4.jpg" alt="image" class="profile-pic">
            </div>
            <div class="item-content flex-grow">
              <h6 class="ellipsis font-weight-normal">David Grey
              </h6>
              <p class="font-weight-light small-text text-muted mb-0">
                The meeting is cancelled
              </p>
            </div>
          </a>
          <a class="dropdown-item">
            <div class="item-thumbnail">
                <img src="<?php echo SYSTEM;?>assets/images/faces/face2.jpg" alt="image" class="profile-pic">
            </div>
            <div class="item-content flex-grow">
              <h6 class="ellipsis font-weight-normal">Tim Cook
              </h6>
              <p class="font-weight-light small-text text-muted mb-0">
                New product launch
              </p>
            </div>
          </a>
          <a class="dropdown-item">
            <div class="item-thumbnail">
                <img src="<?php echo SYSTEM;?>assets/images/faces/face3.jpg" alt="image" class="profile-pic">
            </div>
            <div class="item-content flex-grow">
              <h6 class="ellipsis font-weight-normal"> Johnson
              </h6>
              <p class="font-weight-light small-text text-muted mb-0">
                Upcoming board meeting
              </p>
            </div>
          </a>
        </div>
      </li>
      <li class="nav-item dropdown me-4">
        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
          <i class="mdi mdi-bell mx-0"></i>
          <span class="count"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
          <a class="dropdown-item">
            <div class="item-thumbnail">
              <div class="item-icon bg-success">
                <i class="mdi mdi-information mx-0"></i>
              </div>
            </div>
            <div class="item-content">
              <h6 class="font-weight-normal">Application Error</h6>
              <p class="font-weight-light small-text mb-0 text-muted">
                Just now
              </p>
            </div>
          </a>
          <a class="dropdown-item">
            <div class="item-thumbnail">
              <div class="item-icon bg-warning">
                <i class="mdi mdi-settings mx-0"></i>
              </div>
            </div>
            <div class="item-content">
              <h6 class="font-weight-normal">Settings</h6>
              <p class="font-weight-light small-text mb-0 text-muted">
                Private message
              </p>
            </div>
          </a>
          <a class="dropdown-item">
            <div class="item-thumbnail">
              <div class="item-icon bg-info">
                <i class="mdi mdi-account-box mx-0"></i>
              </div>
            </div>
            <div class="item-content">
              <h6 class="font-weight-normal">New user registration</h6>
              <p class="font-weight-light small-text mb-0 text-muted">
                2 days ago
              </p>
            </div>
          </a>
        </div>
      </li>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
          <img src="<?php echo SYSTEM;?>assets/images/faces/face5.jpg" alt="profile"/>
          <span class="nav-profile-name">Jhonathan Ribeiro</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item">
            <i class="mdi mdi-settings text-primary"></i>
            Settings
          </a>
          <a href="<?php echo SYSTEM;?>logout.php" class="dropdown-item">
            <i class="mdi mdi-logout text-primary"></i>
            Logout
          </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
<div class="container-fluid page-body-wrapper">
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
    <?php 
      foreach($newArray as $v) {
          if ($v["consultar"] == 1) {?>
          <li class="nav-item">
            <a href="<?php echo SYSTEM."modules/".$v["diretorio"]."/".$v["pagina"];?>.php?modulo=<?php echo $modulo;?>" class="nav-link">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title"><?php echo $v["nome_tela"]; ?></span>  
            </a>
          </li>
    <?php }}?>
    </ul>
  </nav>
  <div class="main-panel">
    <div class="content-wrapper">