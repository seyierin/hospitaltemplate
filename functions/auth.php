<?php 
    require_once "functions/formhandler.php";
    require_once "functions/utilities.php";
    class Auth extends Database {
        private $formHandler;
        private $utilities;
        function __construct() {
            parent::__construct();
            $this->formHandler = new formHandler();
            $this->utilities = new Utilities();
        }
        function registerUser() {
            // vaildate form data
            $data = $this->formHandler->validate(['fullname', 'email', 'password', 'confirm_password']);
            if($this->formHandler->isError) return;
            // check email in database 
            $check = $this->select("user", "email = ?", [$data['email']], method: "rowCount");
            if($check > 0) {
                echo $this->utilities->message("Email already exists.", 'error');
                return;
            }
            // insert user into database
            $userData = [
                "full_name"=>$data['fullname'],
                "email"=>$data['email'],
                "password_hash"=>$data['password']
            ];

            if($this->insert("user", $userData)) {
                echo $this->utilities->message("User registered successfully.");
            } else {
                echo $this->utilities->message("Error registering user.", 'error');
            }
    }

    function signin() {
        // check if email and password are set and not empty
        if(!isset($_POST['email']) || !isset($_POST['password']) || empty($_POST['email']) || empty($_POST['password'])) {
            echo "<div class='alert alert-danger'>Email and Password are required.</div>";
            return;
        }
        // fectch user data in database with the email
        $email = htmlspecialchars($_POST['email']);
        $user = $this->db->prepare("SELECT * FROM user WHERE email = ?");
        $user->execute([$email]);
        // if no record found then return incorrect email or password
        if($user->rowCount() == 0) {
            echo "<div class='alert alert-danger'>Incorrect email or password.</div>";
            return;
        }
        $user = $user->fetch(PDO::FETCH_ASSOC);
        // if record found then check if the password matches 
        if(!password_verify($_POST['password'], $user['password'])) {
            //  if password not match retrun incorrect email or password
            echo "<div class='alert alert-danger'>Incorrect email or password.</div>";
            return;
        }
        if($user['status'] != 1) {
            echo "<div class='alert alert-danger'>Your account is not active, contact us.</div>";
            return;
        }
        // if password match then set session for user and redirect to index page or dashbord
        $this->setSession($user['ID']);
        echo "<div class='alert alert-success'>Login successful. Redirecting...</div>";
        header("Location: index.php");
    }

    function setSession($userID) {
        // start session if not started
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $token = bin2hex(random_bytes(16));
        $_SESSION['ID'] = $userID;
        $_SESSION['token'] = $token;
        // update token in database
        $updateToken = $this->db->prepare("UPDATE user SET session_token = ? WHERE ID = ?");
        $updateToken->execute([$token, $userID]);
        return true;
    }

    function logout() {
        // start session if not started
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['ID'])) {
            $userID = htmlspecialchars($_SESSION['ID']);
            // update token in database to empty
            $updateToken = $this->db->prepare("UPDATE user SET session_token = ? WHERE ID = ?");
            $updateToken->execute(["", $userID]);
        }
        // unset all session variables
        session_unset();
        // destroy the session
        session_destroy();
        // redirect to signin page
        
        header("Location: signin.php");
        exit();
    }

    // function update user
    function updateuser() {
        // get user id and session token from session
        // check if id and sesssion token in database
        // get all user data from form
        // validate form data
        // update user data in database
        // show success or error message
    }
}
?>