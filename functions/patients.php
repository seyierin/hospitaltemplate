<?php 
    class patients extends Database {
        private $formHandler;
        private $utilities;
        function __construct() {
            parent::__construct();
            $this->formHandler = new formHandler();
            $this->utilities = new Utilities();
        }

    function addPatient(){
        // valdate role of user
        $this->validateRole('admin');
        $data = $this->formHandler->validate(['first_name', 'last_name', 'dob', 'gender', 'contact', 'email', 'address', 'emergency_contact']);
        if($this->formHandler->isError) return;
        if($this->select("patients", "email = ?", [$data['email']], method: "rowCount") > 0) {
            echo $this->utilities->message("Email already exists.", 'error');
            return;
        }
        if($this->select("patients", "contact = ?", [$data['contact']], method: "rowCount") > 0) {
            echo $this->utilities->message("Contact Number already exists.", 'error');
            return;
        }
        if($this->insert("patients",["first_name"=>$data['first_name'], "last_name"=>$data['last_name'], "dob"=>$data['dob'],"gender"=>$data['gender'],"contact"=>$data['contact'], "email"=> $data['email'], "address"=>$data['address'], "emergency_contact"=>$data['emergency_contact'] ])) {
            echo $this->utilities->message("Patient added successfully.", "success");
        } else {
            echo $this->utilities->message("Error adding patient.", 'error');
        }
    }


    function getPatients(){
        return $this->select("patients", method: "all");
    }

    function getPatient($userID) {
        return $this->select("patients", "patient_id = ?", [$userID]);
    }

function deletePatient($userID){
    return $this->delete("patients", "patient_id = '$userID'");
}

}