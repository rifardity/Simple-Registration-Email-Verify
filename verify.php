<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Verify Food Edu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body class="text-center bg">
  <?php
  require_once 'config/database.php';
  require_once 'class/class.user.php';
  $email =$_GET['email'];
  $token = $_GET['token'];
  if (!isset($email) || !isset($token)) {
    echo "<script>window.location.href='index.php'</script>";
  }else {
    $user = new User();
    if ($user->Verify($email,$token)) {
      echo "<script>
        swal('Verification Successfull !!', 'You Can Login Now', 'success').then((value) => {
          window.location.href='signin.php';
        });
      </script>";
    }else{
      echo "<script>swal('Failed To Verify', 'Please Check Your Db','error');</script>";
    }
  }
  ?>
  <footer class="d-none d-md-block d-lg-block d-xl-block fixed-bottom text-white">Copyright&copy 2017 Rifardi Taufiq . All Right Reserved.</footer>
  <script src="assets/js/jquery-3.3.1.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
