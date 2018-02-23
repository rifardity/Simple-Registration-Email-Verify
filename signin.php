<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Sign In Food Edu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="text-center bg">
  <h2 class="bg-title text-white rounded-bottom">Food Edu</h2>
  <div class="container">
    <div class="card form">
      <div class="card-body">
        <h2 class="font-weight-light">Sign in now</h2>
        <h6 class="card-subtitle mb-2 text-muted">Lets join And <strong> Free </strong>To <strong>Play</strong></h6>
        <br>
        <div class="row">
          <div class="col-sm-6">
            <form method="post">
              <div class="form-group inputform email">
                <label class="sr-only" for="email">Email</label>
                <input type="Email" class="form-control" name="email" placeholder="Email" required>
              </div>
              <div class="form-group inputform password">
                <label class="sr-only" for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>
              <input type="submit" class="btn btn-primary btn-block" name="submit" value="Sign In">
              <p class="font-weight-light text-left note">By signing in, you agree to our terms of services and privacy policy.</p>
              <h6 class="font-weight-light text-left">Dont Have Accout ? <a href="index.php">Create Account</a></h6>
            </form>
          </div>
          <div class="col-sm-6">
            <div class="d-none d-md-block d-lg-block d-xl-block divider">
              <span>Or</span>
            </div>
            <ul class="list-unstyled btn-social">
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
<?php
require_once 'config/database.php';
require_once 'class/class.user.php';
$user = new User();
if ($user->isLogin()!='') {
  header('Location:dashboard.php');
}
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  if ($user->Login($email,$password)) {
      echo "<script>swal('$user->successText You Login ', 'Click Ok To Continue', 'success').then((value) => {
        window.location.href='dashboard.php';
      });</script>";
  }else{
      echo "<script>swal('Fail Login !!', '$user->errorText', 'error');</script>";
  }
}
?>
