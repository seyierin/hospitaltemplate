<?php 
    require_once "functions/utilities.php";
    class formHandler {
        public $isError = false;
        public $formData = [];
        public $data = [];
        public $utilities;
        function __construct(){
            $this->utilities = new Utilities();
        }
        function validate(array $formData = []){
            if(count($formData) == 0) $formData = $this->formData;
            if(count($formData) == 0) return null;
                // ["email", "full_name", "password"]
               foreach($formData as $form){
                    if(!isset($_POST[$form]) || empty($_POST[$form])){
                        echo $this->utilities->message(ucfirst(str_replace("_", " ", $form))." is required", 'error');
                        $this->isError = true;
                        continue;
                    }
                    
                    if($form == "password"){
                        if(isset($_POST['confirm_password'])) {
                             if($_POST['password'] !== $_POST['confirm_password']) {
                                echo $this->utilities->message("Passwords do not match", 'error');
                                $this->isError = true;
                                continue;
                            }
                        }

                         if(strlen($_POST['password']) < 6) {
                                echo $this->utilities->message("Password must be at least 6 characters long", 'error'); 
                                $this->isError = true;
                                continue;
                        }
                    
                    }
                    // if($form == "password") {
                    //     $this->data[$form] = password_hash(htmlspecialchars($_POST[$form]), PASSWORD_DEFAULT);
                    // }else{
                    //     $this->data[$form] = htmlspecialchars($_POST[$form]);
                    // }
                    if($form == "confirm_password") continue;
                    $this->data[$form] = ($form == "password") ? password_hash($this->utilities->sanitizeInput($_POST[$form]), PASSWORD_DEFAULT) : $this->utilities->sanitizeInput($_POST[$form]);
                    
               }  
               if(!$this->isError) {
                   return $this->data;
               }
               return false;
        }
    }