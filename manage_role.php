<?php require_once "include/header.php";
if(isset($_GET['ID']) && $_GET['ID'] != ""){
    $rolePermissions = $roles->get_role(htmlspecialchars($_GET['ID']), true);
    $rolename = $rolePermissions['name'];
    $rolePermissions = $rolePermissions['permissions'];
}
$defaultRoles = $roles->defaultRoles();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = htmlspecialchars($_POST['name']);
    $permissions = [];
    foreach($defaultRoles as $category => $perms){
        foreach($perms as $permKey => $permLabel){
            if(isset($_POST[$category . $permKey])){
                $permissions[$category][] = $permKey;
            }
        }
    }
   if($roles->manage_role($name, json_encode($permissions), isset($_GET['ID']) ? htmlspecialchars($_GET['ID']) : null)){
        echo "<div class='alert alert-success'> Role added successfully </div>";
   }
}
?>
 <div class="container mt-5">
        <h2>Role</h2>
        <form id="roleForm" method="POST">
            <input type="hidden" name="role_id" value="<?= isset($_GET['ID']) ? htmlspecialchars($_GET['ID']) : "" ?>">
            <div class="mb-3">
                <label for="roleName" class="form-label">Role Name</label>
                <input type="text" class="form-control" name="name" id="roleName" value="<?=  $_POST['name'] ?? $rolename  ?? "" ?>" placeholder="e.g., Customer Support" required>
            </div>

            <!-- Dynamic Role Sections -->
            <div class="accordion" id="roleAccordion">
                <?php foreach ($defaultRoles as $category => $permissions): 
                        
                    ?>
                    <div class="accordion-item">
   
    <div id="collapse<?= $category ?>" class="accordion-collapse collapse show" aria-labelledby="heading<?= $category ?>" data-bs-parent="#roleAccordion">
        <div class="accordion-body">
            <div class="form-check">
                <!-- <input class="form-check-input category-check" type="checkbox" value="<?= htmlspecialchars($category) ?>" id="<?= $category ?>CategoryCheck" data-category="<?= $category ?>"> -->
                <label class="form-check-label fw-bold h4" for="<?= $category ?>CategoryCheck">
                    <?= ucfirst(str_replace("_", " ", htmlspecialchars($category))) ?>
                </label>
            </div>
            <?php if (!empty($permissions)): ?>
                <?php foreach ($permissions as $permissionKey => $permissionLabel): 
                    $checked = (isset($rolePermissions[$category]) && in_array($permissionKey, $rolePermissions[$category]) || (isset($_POST[$category . $permissionKey]))) ?  "checked" : "";
                    ?>
                    <div class="form-check ms-3">
                        <input class="form-check-input permission-check" name="<?= $category . $permissionKey ?>" type="checkbox" value="<?= htmlspecialchars($permissionKey) ?>" id="<?= $category . $permissionKey ?>" data-category="<?= $category ?>" <?= $checked ?>>
                        <label class="form-check-label" for="<?= $category . $permissionKey ?>">
                            <?= htmlspecialchars($permissionLabel) ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

                <?php endforeach; ?>
            </div>
                <div class="custommessage"></div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>

<?php require_once "include/footer.php"; ?>