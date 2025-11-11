<?php 
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // check if user_id and token are set in session and not empty
    if(!isset($_SESSION['ID']) || !isset($_SESSION['token']) || empty($_SESSION['ID']) || empty($_SESSION['token'])) {
        // redirect to signin page
        header("Location: login.php");
        exit();
    }
    

    require_once "functions/database.php";
    $database = new Database();
    $user = $database->db->prepare("SELECT * FROM user WHERE ID = ? AND session_token = ?");
    $user->execute([htmlspecialchars($_SESSION['ID']), htmlspecialchars($_SESSION['token'])]);
    // if no record found then redirect to signin page
    if($user->rowCount() == 0) {
        // redirect to signin page
        header("Location: login.php");
        exit();
    }
    $user = $user->fetch(PDO::FETCH_ASSOC);

    if(isset($_GET['logout'])) {
        require_once "functions/auth.php";
        $auth = new Auth();
        $auth->logout();
    }