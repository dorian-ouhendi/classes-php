<?php
session_start();
Class User {
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname; 
    private $password;

    public function __construct () { 
      //  try { 
      //   $this->co = new PDO('mysql:host=localhost;dbname=classes','root',''); 
      //   echo 'Ok';
      //  } 
      //  catch (PDOException $e) {
      //     echo $e->getMessage();
      //  }
     }

     public function getPDO () {
        try {
           return new PDO('mysql:host=localhost;dbname=classes','root',''); 
        }
        catch (PDOException $e) {
         echo $e->getMessage();
      }
     }

     public function register ($login,$email,$firstname,$lastname,$password) {
        $pdo = $this->getPDO();
        $requete = $pdo->prepare("INSERT INTO `utilisateurs` (`login`, `email`, `firstname`, `lastname`, `password`) VALUES ('$login','$email','$firstname','$lastname','$password')");
        $requete-> execute();
        $requete_co = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = '$login'");
        $requete_co-> execute();
        $conn = $requete_co->fetchAll(PDO::FETCH_ASSOC);
        var_dump($conn);
     }

     public function connect ($login, $password){
        $pdo = $this->getPDO();
        $connect = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$password'");
        $connect->execute();
        $conn = $connect->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION["user"] = $conn;
        var_dump($_SESSION["user"]);
     }
     
     public function update ($login,$email,$firstname,$lastname,$password) {
        $this->id = $_SESSION['user'][0]['id'];
        $pdo = $this->getPDO();
        $update = $pdo->prepare("UPDATE `utilisateurs` SET `login`='$login',`email`='$email',`firstname`='$firstname',`lastname`='$lastname',`password`='$password' WHERE `id`= '$this->id'");
        $update->execute();
        $conn = $update->fetchAll(PDO::FETCH_ASSOC);
        var_dump($_SESSION);
     }

     public function delete ($id){
        $pdo = $this->getPDO();
        $this->id = $_SESSION['user'][0]['id'];
        $delete = $pdo->prepare("DELETE FROM utilisateurs WHERE id = '$this->id'");
        $delete->execute();
        echo 'Session delete';
        // session_destroy();
     }

     public function disconnect () {
        session_unset();
        session_destroy();
     }

     public function getAllInfos () {
        $pdo = $this->getPDO();
        $this->id = $_SESSION['user'][0]['id'];
        $get_info = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = '$this->id'");
        $get_info->execute();
        $conn = $get_info->fetchAll(PDO::FETCH_ASSOC);
        var_dump($conn);
     }

     public function isConnected(){
      $this->login = $_SESSION['user'];
          if(isset($_SESSION['user'])){
          echo 'connect';
  }       
          else{
          echo 'not connect';
  }
  }
     
     public function getLogin () {
      $pdo = $this->getPDO();
      $this->id = $_SESSION['user'][0]['id'];
      $get_log = $pdo->prepare("SELECT * FROM `utilisateurs` WHERE `id` ='$this->id'");
      $get_log->execute();
      $conn = $get_log->fetchAll(PDO::FETCH_ASSOC);
      echo $conn[0]['login'].'<br/>';
   }

     public function getEmail () {
      $pdo = $this->getPDO();
      $this->id = $_SESSION['user'][0]['id'];
      $get_email = $pdo->prepare("SELECT * FROM `utilisateurs` WHERE `id` ='$this->id'");
      $get_email->execute();
      $conn = $get_email->fetchAll(PDO::FETCH_ASSOC);
      echo $conn[0]['email'].'<br/>';
     }

     public function getFirstname() {
      $pdo = $this->getPDO();
      $this->id = $_SESSION['user'][0]['id'];
      $get_firstname = $pdo->prepare("SELECT * FROM `utilisateurs` WHERE `id` ='$this->id'");
      $get_firstname->execute();
      $conn = $get_firstname->fetchAll(PDO::FETCH_ASSOC);
      echo $conn[0]['firstname'].'<br/>';
     }

     public function getLastname() {
      $pdo = $this->getPDO();
      $this->id = $_SESSION['user'][0]['id'];
      $get_name = $pdo->prepare("SELECT * FROM `utilisateurs` WHERE `id` ='$this->id'");
      $get_name->execute();
      $conn = $get_name->fetchAll(PDO::FETCH_ASSOC);
      echo $conn[0]['lastname'].'<br/>';
     }

}
$user = new User();
// $user-> register("PDO","PDO@gmail.com","Classes","class","1");
$user->connect("Lira","2");
// $user->update("Lira","LIRA@LIVE.FR","Li","Ra","2");
// $user->delete("");
// $user->disconnect("");
$user->isConnected();
// $user->getAllInfos();
// $user->getLogin();
// $user->getEmail();
// $user->getFirstname();
// $user->getLastname();
// var_dump($user);
?>