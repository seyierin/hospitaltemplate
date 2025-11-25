<?php 
    class Department extends Database {
        private $formHandler;
        private $utilities;
        function __construct() {
            parent::__construct();
            $this->formHandler = new formHandler();
            $this->utilities = new Utilities();
        }

    function addDepartment(){
        // valdate role of user
        $this->validateRole('admin');
        $data = $this->formHandler->validate(['name', 'description']);
        if($this->formHandler->isError) return;
        if($this->select("departments", "department_name = ?", [$data['name']], method: "rowCount") > 0) {
            echo $this->utilities->message("Department already exists.", 'error');
            return;
        }
        
        if($this->insert("departments",["department_name"=>$data['name'], "description"=>$data['description'] ])) {
            echo $this->utilities->message("Department added successfully. <a href=''>Click here </a> to see update.", "success");
        } else {
            echo $this->utilities->message("Error adding department.", 'error');
        }
    }


    function getDepartments(){ 
        return $this->select("departments", method: "all");
    }


    function getDepartment($userID){
        return $this->select("departments", "department_id = ?", [$userID]);
    }
    
    function updateDepartment($userID) {
        $data = $this->formHandler->validate([ 'name', 'description']);
        if($this->formHandler->isError) return;
        // check if email not in database 
        $check = $this->select("departments", "department_name = ? AND department_id != ?", [$data['name'], $userID], method: "rowCount");
        if($check > 0) {
             echo $this->utilities->message("department name already exits", 'error'); return;
        }
        $update = $this->update("departments", ["department_name"=>$data['name'], "description"=>$data['description'] ], "department_id ='$userID'");
        if($update) {
             echo $this->utilities->message("department updated successfully. <a href=''>Click here </a> to see update.", "success");
        } else {
            echo $this->utilities->message("Error updating department", 'error');
        }
    }

    }