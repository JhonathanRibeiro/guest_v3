<?php
include('environment.php'); 
include("conection.php");

if(isset($_POST['email']) || isset($_POST['senha'])) {
    if(strlen($_POST['email']) == 0) {
        $msg = 'Preencha seu e-mail';
    } else if(strlen($_POST['senha']) == 0) {
        $msg = '&nbsp; Preencha sua senha';
    } else {
        //limpeza de segurança contra SQL Injection
        $email = $con->real_escape_string($_POST['email']);
        $senha = $con->real_escape_string($_POST['senha']);

        $sql_code = "SELECT
        us.usuario_id,
        us.nome AS us_nome,
        us.email,
        us.senha,
        us.empresa_id,
        us.acesso_id AS privilegio,
        emp.nome AS emp_nome,
        nv.nome AS nome_privilegio
      FROM
        tb_usuarios us
      INNER JOIN tb_empresa emp ON
        (us.empresa_id = emp.empresa_id)
      INNER JOIN tb_nivel_de_acesso nv ON
        (us.acesso_id = nv.acesso_id)
        WHERE email = '$email' AND senha = '$senha'";

        $sql_query = $con->query($sql_code) or die("Falha na execução do código SQL." . $con->error);
        $quantidade = $sql_query->num_rows;

        if($quantidade > 0) {
            $usuario = $sql_query->fetch_assoc();
            if(!isset($_SESSION)) {session_start();}

            $_SESSION['id'] = $usuario['usuario_id'];
            $_SESSION['nome'] = $usuario['us_nome'];
            $_SESSION['empresa'] = $usuario['empresa_id'];
            $_SESSION['privilegio'] = $usuario['nome_privilegio'];
            header("Location: index.php");

        } else {
            echo "Falha na conexão. E-mail ou senha incorretos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Template Admin</title>
  <link rel="stylesheet" href="<?php echo SYSTEM?>assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo SYSTEM?>assets/vendors/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo SYSTEM?>assets/css/style.css">
  <link rel="shortcut icon" href="<?php echo SYSTEM?>assets/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="<?php echo SYSTEM?>assets/images/logo.svg" alt="logo">
              </div>

            <div style="color:red;">
                <?php if(isset($msg)){echo $msg;}?>
            </div>
              
              <form class="pt-3" method="post">
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Usuário">
                </div>
                <div class="form-group">
                  <input type="password" name="senha" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Senha">
                </div>
                <div class="mt-3">
                  <input type="submit" value="LOGIN" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                </div>
                <br>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo SYSTEM?>assets/vendors/base/vendor.bundle.base.js"></script>
  <script src="<?php echo SYSTEM?>assets/js/off-canvas.js"></script>
  <script src="<?php echo SYSTEM?>assets/js/hoverable-collapse.js"></script>
  <script src="<?php echo SYSTEM?>assets/js/template.js"></script>
</body>
</html>
