<?php
    class editpatient extends database {
        private $formHandler;
       private $utilities;
       function __construct() {
           parent::__construct();
           $this->formHandler = new formHandler();
           $this->utilities = new Utilities();
       }
       function updatepatient($userID) {
           $data = $this->formHandler->validate([ 'first_name', 'last_name', 'email', 'dob', 'gender', 'address', 'contact', 'emergency_contact']);
           if($this->formHandler->isError) return;
           // check if email not in database 
           $check = $this->select("patients", "email = ? AND patient_id != ?", [$data['email'], $userID], method: "rowCount");
           if($check > 0) {
                echo $this->utilities->message("Email already exits", 'error'); return;
           }
           $update = $this->update("patients", ["first_name"=>$data['first_name'], "last_name"=>$data['last_name'],  "dob"=>$data['dob'], "gender"=>$data['gender'], "contact"=>$data['contact'], "email"=>$data['email'], "address"=>$data['address'], "emergency_contact"=>$data['emergency_contact'] ], "patient_id ='$userID'");
           if($update) {
                echo $this->utilities->message("Profile updated successfully.", "success");
           } else {
               echo $this->utilities->message("Error updating profile", 'error');
           }
       }
   }
