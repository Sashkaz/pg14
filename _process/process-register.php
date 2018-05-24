<?php
    session_start();
    include("../_include/_models/db.php");
    include("../_include/_models/form-authorizer.php");
    $db = new Database();
    $createAccount = new formAuthorizer();

    if(isset($_POST) && !empty($_POST)){
        if($n)
    }

?>