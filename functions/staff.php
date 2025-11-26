<?php 
    class staff extends Database {
        private $formHandler;
        private $utilities;
        function __construct() {
            parent::__construct();
            $this->formHandler = new formHandler();
            $this->utilities = new Utilities();
        }

    function addStaff(){
        // $this->validateRole(["staff"=>"add"], true);
        $data = $this->formHandler->validate(['name', 'role', 'email', 'department', 'contact', 'salary', 'status']);
        if($this->formHandler->isError) return;
        if($this->select("staff", "email = ?", [$data['email']], method: "rowCount") > 0) {
            echo $this->utilities->message("Email already exists.", 'error');
            return;
        }
        if($this->select("staff", "phone = ?", [$data['contact']], method: "rowCount") > 0) {
            echo $this->utilities->message("Contact Number already exists.", 'error');
            return;
        }
        $payload = [
            "name"=>$data['name'],
            "department_id"=>$data['department'],
            "role"=>$data['role'],
            "salary"=>$data['salary'] ?? null,
            "email"=>$data['email'],
            "phone"=>$data['contact'],
            "status"=>$data['status'] ?? 'active'
        ];
        if($this->insert("staff", $payload)) {
            echo $this->utilities->message("Staff added successfully. <a href=''>Click here </a> to see update.", "success");
        } else {
            echo $this->utilities->message("Error adding staff.", 'error');
        }
    }


    function getStaffs(){
        return $this->select("staff", method: "all");
    }
function getStaff($userID){
    return $this->select("staff", "staff_id = ?", [$userID]);
}

    function deleteStaff($userID){
        return $this->delete("staff", "staff_id = '$userID'");
    }
    

    function updateStaff($userID) {
        $this->validateRole(["staff"=>"edit"], true);
        $data = $this->formHandler->validate(['name', 'role', 'email', 'contact', 'department', 'salary', 'status']);
        if($this->formHandler->isError) return;
        $check = $this->select("staff", "email = ? AND staff_id != ?", [$data['email'], $userID], method: "rowCount");
        if($check > 0) {
             echo $this->utilities->message("Email already exits", 'error'); return;
        }
        $update = $this->update("staff", [
            "name"=>$data['name'],
            "department_id"=>$data['department'],
            "role"=>$data['role'],
            "salary"=>$data['salary'] ?? null,
            "email"=>$data['email'],
            "phone"=>$data['contact'],
            "status"=>$data['status'] ?? 'active'
        ], "staff_id ='$userID'");
        if($update) {
             echo $this->utilities->message("Profile updated successfully. <a href=''>Click here </a> to see update.", "success");
        } else {
            echo $this->utilities->message("Error updating profile", 'error');
        }
    }

}