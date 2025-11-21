<?php 
    class Doctors extends Database {
        private $formHandler;
        private $utilities;
        function __construct() {
            parent::__construct();
            $this->formHandler = new formHandler();
            $this->utilities = new Utilities();
        }

    function addDoctor(){
        // valdate role of user
        $this->validateRole('admin');
        $data = $this->formHandler->validate(['name', 'specialty', 'email', 'contact']);
        if($this->formHandler->isError) return;
        if($this->select("doctors", "email = ?", [$data['email']], method: "rowCount") > 0) {
            echo $this->utilities->message("Email already exists.", 'error');
            return;
        }
        if($this->select("doctors", "phone = ?", [$data['contact']], method: "rowCount") > 0) {
            echo $this->utilities->message("Contact Number already exists.", 'error');
            return;
        }
        if($this->insert("doctors",["name"=>$data['name'], "specialization"=>$data['specialty'], "email"=>$data['email'],"phone"=>$data['contact'] ])) {
            echo $this->utilities->message("Doctor added successfully. <a href=''>Click here </a> to see update.", "success");
        } else {
            echo $this->utilities->message("Error adding doctor.", 'error');
        }
    }


    function getDoctors(){
        return $this->select("doctors", method: "all");
    }
function getDoctor($userID){
    return $this->select("doctors", "doctor_id = ?", [$userID]);
}

    function deleteDoctor($userID){
        return $this->delete("patients", "doctor_id = '$userID'");
    }
    
}