<?php
defined('APPS') OR exit('No direct script access allowed');
// echo password_hash(123456, PASSWORD_DEFAULT);
// exit();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <div class="login-box" style="margin-bottom:15em;">
    <div class="login-logo">
      <a href="./"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
      <?php if(isset($_SESSION["STATUS"]) && $_SESSION["STATUS"] === FALSE){?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $_SESSION["MSG"];?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php unset($_SESSION["STATUS"],$_SESSION["MSG"]);} ?>
        <form action="apps/login/do_login.php?action=check_login" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="user" name="user" placeholder="Username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-6">
             <a class="btn btn-primary btn-block" href="./?page=dashboard" role="button"><i class="fa fa-ambulance" aria-hidden="true">   </i> แจ้งซ่อม  </a>
              </div>
              <div class="col-6">
               
            <div class="btn-group">
                      <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-key"></i> Login/เข้าใช้</button>
                     
             </div>
              
              </div>
            <!-- /.col -->
          </div>
          
        </form>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <script>
    window.setTimeout(function() {
      $(".alert").fadeTo(700, 0).slideUp(1000, function() {
          $(this).remove()
      })
    }, 2e3);
  </script>

</body>

</html>
