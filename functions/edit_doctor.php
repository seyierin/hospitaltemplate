<?php
    class editdoctor extends database {
        private $formHandler;
       private $utilities;
       function __construct() {
           parent::__construct();
           $this->formHandler = new formHandler();
           $this->utilities = new Utilities();
       }
       function updateDoctor($userID) {
           $data = $this->formHandler->validate([ 'name', 'specialty', 'email','contact']);
           if($this->formHandler->isError) return;
           // check if email not in database 
           $check = $this->select("doctors", "email = ? AND doctor_id != ?", [$data['email'], $userID], method: "rowCount");
           if($check > 0) {
                echo $this->utilities->message("Email already exits", 'error'); return;
           }
           $update = $this->update("doctors", ["name"=>$data['name'], "specialization"=>$data['specialty'],  "email"=>$data['email'], "phone"=>$data['contact']], "doctor_id ='$userID'");
           if($update) {
                echo $this->utilities->message("Profile updated successfully.", "success");
           } else {
               echo $this->utilities->message("Error updating profile", 'error');
           }
       }
   }
