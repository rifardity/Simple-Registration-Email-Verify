<!DOCTYPE html>
<html>
<?php
require_once 'config/database.php';
require_once 'class/class.user.php';
session_start();
$user = new User();
if ($user->isLogin()=='') {
  header('Location:signin.php');
}
if (isset($_POST['logout'])) {
  $user->Logout();
  header('Location:signin.php');
}
$data = $user->View($_SESSION['user_session']);
?>
<head>
  <meta charset="utf-8">
  <title>Dashboard Food Edu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="text-center bg">
  <h2 class="bg-title text-white rounded-bottom">Food Edu</h2>
  <div class="container">
    <div class="card form">
      <div class="card-body">
        <h2 class="font-weight-light">Dashboard</h2>
        <h6 class="card-subtitle mb-2 text-muted">Lets join And <strong> Free </strong>To <strong>Play</strong></h6>
        <br>
        <div class="row">
          <div class="col-sm-6">
            <div class="text-center">
              <img src="assets/img/user.png" class="rounded" alt="Image User">
            </div>
            <form   method="post">
              <h5><?php echo "$data->name"; ?></h5>
              <input class="btn btn-primary" type="submit" name="logout" value="Logout">
            </form>
          </div>
          <div class="col-sm-6">
            <div class="d-none d-md-block d-lg-block d-xl-block divider">
              <span>Or</span>
            </div>
            <ul class="list-unstyled btn-social">
              <h6 class="text-muted">Verify Your Identity With :</h6>
              <li><button type="submit" class="btn btn-block facebook"><i class="fa fa-facebook "> | </i> Facebook</button></li>
              <li><button type="submit" class="btn btn-block whatsapp"><i class="fa fa-whatsapp "> | </i> Whatsapp</button></li>
              <li><button type="submit" class="btn btn-block telegram"><i class="fa fa-telegram "> | </i> Telegram</button></li>
              <li><button type="submit" class="btn btn-block line"><i class="	fa fa-wechat "> | </i> Line</button></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="d-none d-md-block d-lg-block d-xl-block fixed-bottom text-white">Copyright&copy 2017 Rifardi Taufiq . All Right Reserved.</footer>
  <script src="assets/js/jquery-3.3.1.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
