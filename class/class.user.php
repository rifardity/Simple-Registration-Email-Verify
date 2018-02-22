<?php
  /**
   * Class For User
   */
  class User
  {
    private $db;
    function __construct()
    {
      $database = new Database();
      $this->db = $database->Connect();
    }

		function isLoggedIn(){
			if(isset($_SESSION['userData'])){
				return true;
			}
			return false;
		}

    public function Register($name,$email,$pass,$telp,$token){
      try {
        $stmt = $this->db->prepare("INSERT INTO user(name,email,password,telp,token) VALUES(:name,:email,:password,:telp,:token)");
        $stmt->bindparam(":name", $name);
        $stmt->bindparam(":email", $email);
        $stmt->bindparam(":password", $pass);
        $stmt->bindparam(":telp", $telp);
        $stmt->bindparam(":token", $token);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        if ($stmt->errorInfo()[1]==1062) {
          $this->errorText = 'Email Sudah Terdaftar';
        }else{
          $this->errorText = $stmt->errorInfo()[2];
        }
        return false;
      }

    }

    public function Verify($email,$token){
      try {
        $stmt = $this->db->prepare("SELECT id FROM user WHERE email=:email and token=:token and confirmed=0");
        $stmt->bindparam(":email", $email);
        $stmt->bindparam(":token", $token);
        $stmt->execute();
        $stmt->fetch(PDO::FETCH_OBJ);
        if ($stmt->rowCount()>0) {
          $sql = $this->db->prepare("UPDATE user SET confirmed=1, token='' WHERE email=:email");
          $sql->bindparam(":email", $email);
          $sql->execute();
          return true;
        }else{
          $this->errorText = $stmt->errorInfo()[1];
          return false;
        }
      } catch (PDOException $e) {
        $this->errorText = $stmt->errorInfo()[2];
        return false;
      }
    }

    public function Login($email,$password){
      try {
        $stmt = $this->db->prepare("SELECT id, name, email, password, confirmed FROM user WHERE email=:email");
        $stmt->bindparam(":email",$email);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        if ($stmt->rowCount()>0) {
          if (password_verify($password, $data->password)) {
            if ($data->confirmed == 1) {
              $this->successText = "$data->name";
              $_SESSION['user_session'] = $data->email;
              return true;
            }else {
              $this->errorText = "Please Verify Your Email Address";
              return false;
            }
          }else{
              $this->errorText = "Please Check Your Password";
              return false;
          }
        }else {
          $this->errorText = "Please Check Your Input";
          return false;
        }
      } catch (PDOException $e) {
        return false;
      }
    }
    public function View($email){
      try {
        $stmt = $this->db->prepare("SELECT name FROM user WHERE email=:email");
        $stmt->bindparam(":email",$email);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        return $data;
      } catch (PDOException $e) {
        return false;
      }

    }
    public function isLogin(){
      if (isset($_SESSION['user_session'])) {
        return true;
      }
    }
    public function Logout(){
      session_destroy();
      unset($_SESSION['user_session']);
      return true;
    }
  }

?>
