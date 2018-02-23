<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registration Food Edu</title>
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
        <h2 class="font-weight-light">Sign up now</h2>
        <h6 class="card-subtitle mb-2 text-muted">Lets join And <strong> Free </strong>To <strong>Play</strong></h6>
        <br>
        <div class="row">
          <div class="col-sm-6">
            <form method="post">
              <div class="form-group inputform name">
                <label class="sr-only" for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Fullname" required>
              </div>
              <div class="form-group inputform email">
                <label class="sr-only" for="email">Email</label>
                <input type="Email" class="form-control" name="email" placeholder="Email" required>
              </div>
              <div class="form-group inputform phone">
                <label class="sr-only" for="phone">Phone Number</label>
                <input type="tel" class="form-control" name="phone" placeholder="Phone Number" required>
              </div>
              <div class="form-group inputform password">
                <label class="sr-only" for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>
              <input type="submit" class="btn btn-primary btn-block" name="submit" value="Sign Up">
              <p class="font-weight-light text-left note">By signing up, you agree to our terms of services and privacy policy.</p>
            </form>
          </div>
          <div class="col-sm-6">
            <div class="d-none d-md-block d-lg-block d-xl-block divider">
              <span>Or</span>
            </div>
            <ul class="list-unstyled btn-social">
              <li><button type="submit" class="btn btn-block facebook"><i class="fa fa-facebook "> | </i> Facebook</button></li>
              <li><button type="submit" class="btn btn-block whatsapp"><i class="fa fa-whatsapp"> | </i> Whatsapp</button></li>
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
use PHPMailer\PHPMailer\PHPMailer;
require_once 'vendor/autoload.php';
$user = new User();
if ($user->isLogin()!='') {
  header('Location:dashboard.php');
}
  if (isset($_POST['submit'])) {
    $name =$_POST['name'];
    $email= $_POST['email'];
    $phone= $_POST['phone'];
    $password= $_POST['password'];
    $str='alkqmeroiACVMNEURPYKvx9324017f';
    $str = str_shuffle($str);
    $token = substr($str,0,10);
    $hasedPassword = password_hash($password,PASSWORD_DEFAULT);
    if ($user->Register($name,$email,$hasedPassword,$phone,$token)) {
      $mail = new PHPMailer;
      $mail->isSMTP();
      $mail->SMTPDebug = 0;
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587;
      $mail->SMTPSecure = 'tls';
      $mail->SMTPAuth = true;
      $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );
      $mail->Username = "rifarditaufiqyufananda.if@gmail.com";
      $mail->Password = "dadada123";
      $mail->setFrom('rifarditaufiqyufananda.if@gmail.com', 'Food Edu');
      $mail->addAddress($email, $name);
      $mail->Subject = 'Verification Email Address';
      $mail->isHtml(true);
      $mail->Body = "Verify Your Email Address With Link Below <br><br>
      <a href='http://game29.000webhostapp.com/verify.php?email=$email&token=$token'>VERIFY NOW<a>
      ";
      if (!$mail->send()){
        echo "<script>swal('Fail Send Email Verification !!', 'Please Check Your Web System', 'error');</script>";
      }
      else {
        echo "<script>swal('Registration Successfull !!', 'Please Check Your Email Address For Verification', 'success').then((value) => {
          window.location.href='signin.php';
        });</script>";
      }

    }else {
      echo "<script>swal('Fail Registration !!', 'Error Infor $user->errorText', 'error');</script>";
    }
  }
?>
