<?php
class roles extends database
{
         private $utilities;
        function __construct() {
            parent::__construct();
            $this->formHandler = new formHandler();
            $this->utilities = new Utilities();
        }
    public function manage_role($name, $permissions, $id = null)
    {
        if($name == "") return $this->utilities->message("Enter role name", "error");
        if($permissions == "") return $this->utilities->message("No permission selected or passed","error");
        $check = $this->select("roles", "ID != ? and name = ?", [$id ?? "", $name]);
        if(is_array($check)) return $this->utilities->message("$name already exists", "error");
        $data = ["name"=>$name, "permissions"=>base64_encode($permissions)];
        if($id != null && $id != ""){
            if(!$this->validateRole(["roles"=>"edit"], true)) return;
            return $this->update("roles", $data, "ID = '$id'", "$name Updated");
        }
        if(!$this->validateRole(["roles"=>"new"], true)) return;
        return $this->quick_insert("roles", $data, "$name Created.");
    }

    public function get_role($roleID = null) {
        if($roleID == null) {
            return $this->select("roles", method: "all");
        }
        $role = $this->select("roles", "ID = ?",[$roleID]);
        $rolePermissions = htmlspecialchars_decode(base64_decode($role['permissions']));
        return json_decode($rolePermissions, true) ?? [];
    }

    public function validateRole($permission, $message = false)
    {
        if(!is_array($permission)) {
            return (isset(ADMINROLE[$permission]) && is_array(ADMINROLE[$permission]) && count(ADMINROLE[$permission]) > 0) ? true : false;
        }
        $key = array_key_first($permission);
        $is_permission = (isset(ADMINROLE[$key]) && in_array($permission[$key], ADMINROLE[$key])) ?  true : false;
        if(!$is_permission && $message != false) $this->utilities->message(is_string($message) ? $message :"You can not perfrom this action", "error");
        return $is_permission;
    }

    function defaultRoles() : array {
        return json_decode(base64_decode($this->get_settings("roles")), true);
    }
}
