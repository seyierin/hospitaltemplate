<?php 
    // function updateUser($userID) {
    //         // get full and email
    //         if(!isset($_POST['fullname']) || !isset($_POST['email']) || empty($_POST['email']) || empty($_POST['fullname'])) {
    //             echo "<div class='bg-light-danger text-danger'>Fill your full name and email</div>";
    //             return;
    //         }
    //         // check if email not in database 
    //          $user = $this->db->prepare("SELECT * FROM users WHERE email = ? and user_id != ?");
    //         $user->execute([htmlspecialchars($_POST['email']), htmlspecialchars($userID)]);
    //         if($user->rowCount() > 0) {
    //              echo "<div class='bg-light-danger text-danger'>Email already exits</div>";
    //             return;
    //         }
    //         // update 
    //          $update = $this->db->prepare("UPDATE users SET full_name = ?, email = ? WHERE user_id = ?");
    //         $update = $update->execute([htmlspecialchars($_POST['fullname']), htmlspecialchars($_POST['email']), $userID]);
    //         if($update) {
    //              echo "<div class='bg-light-success text-success'>Profile updated successfully</div>";
    //         } else {
    //              echo "<div class='bg-light-danger text-danger'>Error updating profile</div>";
    //         }
    //     }
    require_once "functions/formhandler.php";
    require_once "functions/utilities.php";
    class user extends database {
         private $formHandler;
        private $utilities;
        function __construct() {
            parent::__construct();
            $this->formHandler = new formHandler();
            $this->utilities = new Utilities();
        }
        function updateUser($userID) {
            $data = $this->formHandler->validate(['picture', 'title', 'firstname', 'lastname', 'email', 'address', 'phonenumber']);
            if($this->formHandler->isError) return;
            // check if email not in database 
            $check = $this->select("user", "email = ? AND ID != ?", [$data['email'], $userID], method: "rowCount");
            if($check > 0) {
                 echo $this->utilities->message("Email already exits", 'error'); return;
            }
            $update = $this->update("user", ["title"=>$data['title'], "first_name"=>$data['firstname'], "last_name"=>$data['lastname'], "phone_number"=>$data['phonenumber'], "email"=>$data['email'], "address"=>$data['address'], "profile_image"=>$data['picture'] ], "ID ='$userID'");
            if($update) {
                 echo $this->utilities->message("Profile updated successfully.", "success");
            } else {
                echo $this->utilities->message("Error updating profile", 'error');
            }
        }
    }


