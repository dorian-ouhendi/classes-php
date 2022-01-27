<?php 
session_start();
class User {
    protected $co;
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname; 
    private $password;

    public function __construct () {
       $this->co = mysqli_connect('localhost','root','','classes');
    //    var_dump($this->co);
    }

    public function register ($login, $password, $email, $firstname, $lastname) {
        $requete = mysqli_query ($this->co, "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES ( '$login', '$password', '$email', '$firstname', '$lastname')");

        $verif_user = mysqli_query($this->co,"SELECT * FROM utilisateurs WHERE login = '$login'");
        $result_verif_user = mysqli_fetch_all($verif_user, MYSQLI_ASSOC);
        // var_dump($result_verif_user);
        // return ($result_verif_user);
    }

    public function connect ($login, $password) {
        $verif_co = mysqli_query($this->co,"SELECT * FROM utilisateurs WHERE login = '".$login."' AND password = '".$password."'");
        $result_verif_co = mysqli_fetch_assoc($verif_co);
        $_SESSION["user"] = $result_verif_co;
        // var_dump($result_verif_co);
        $this->login = $result_verif_co['login'];
        $this->password = $result_verif_co['password'];
    }

    public function disconnect () {
        session_unset();
        session_destroy();
    }

    public function delete ($id) {
        $this->id = $_SESSION['user']['id'];
        $result_verif_user = mysqli_query ($this->co, "DELETE FROM `utilisateurs` WHERE `id`= '$this->id'");
    }

    public function update ($login, $password, $email, $firstname, $lastname) {
        $this->id = $_SESSION['user']['id'];
        $result_verif_user = mysqli_query ($this->co, "UPDATE `utilisateurs` SET `login`='$login',`password`='$password',`email`='$email',`firstname`='$firstname',`lastname`='$lastname' WHERE `id`= '$this->id'");
        echo 'update OK';
    }

    public function isConnected(){
        $this->id = $_SESSION["user"]['id'];
        $result_all = mysqli_query($this->co, "SELECT `id` FROM `utilisateurs` WHERE `id` = '$this->id'");
        $result_verif_all = mysqli_fetch_assoc($result_all);
        echo $result_verif_all['id'];
        return true;
    }

    public function getAllInfos () {
        $this->id = $_SESSION["user"]["id"];
        $result_all = mysqli_query($this->co, "SELECT * FROM `utilisateurs` WHERE `id` = '$this->id'");
        $result_verif_all = mysqli_fetch_assoc($result_all);
        var_dump($result_verif_all);
    }

    public function getLogin (){
        $this-> id = $_SESSION["user"]["id"];
        $verif_log = mysqli_query($this->co,"SELECT `login` FROM `utilisateurs` WHERE `id` ='$this->id'");
        $result_verif_log = mysqli_fetch_assoc($verif_log);
        // $this->login = $result_verif_log['login'];
        echo $result_verif_log['login'];
    }

    public function getEmail () {
        $this-> id = $_SESSION["user"]["id"];
        $verif_email = mysqli_query($this->co, "SELECT `email` FROM `utilisateurs` WHERE `id` = '$this->id'");
        $result_verif_email = mysqli_fetch_assoc($verif_email);
        echo $result_verif_email['email'];
    }

    public function getFirstname (){
        $this-> id = $_SESSION["user"]["id"];
        $verif_firstame = mysqli_query($this->co,"SELECT `firstname` FROM `utilisateurs` WHERE `id` = '$this->id'");
        $result_verif_firstname = mysqli_fetch_assoc($verif_firstame);
        echo $result_verif_firstname['firstname'];
    }

    public function getLastname (){
        $this-> id = $_SESSION["user"]["id"];
        $verif_name = mysqli_query($this->co, "SELECT `lastname` FROM `utilisateurs` WHERE `id`= '$this->id'");
        $result_verif_name = mysqli_fetch_assoc($verif_name);
        echo $result_verif_name['lastname'];
    }

}

$user = new User(); 
// $user->register("Alealize","1","Dorianouhendi@gmail.com","Dorian","Ouhendi");
$user->connect("Pixel","2");
// $user->update("Pixel", "2", "Pixel@gmail.com", "Pix", "El");
// $user->disconnect();
// $user->delete("");
$user->isConnected();
$user->getAllInfos();
$user->getLogin();
$user->getEmail();
$user->getFirstname();
$user->getLastname();
// var_dump($user);
// var_dump($_SESSION);
?>