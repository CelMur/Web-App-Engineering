<?php
    if(isset($_POST)){
        
        require_once("db/dbh.inc.php");
        require_once("db/db.user.uidExists.inc.php");
        require_once("db/db.user.getId.inc.php");
        require_once("db/db.user.verifyPassword.inc.php");
        require_once("hash.inc.php");
        require_once("login-functions.inc.php");

        //TODO:sanitize user input
        $name = $_POST["uid"];
        $pwd =  $_POST["pwd"];

        if(emptyInputLogin($name, $pwd) !== false){
            header("location: ../login.php?err=emptyInput");
            exit();
        }

        if(!verifyLogin($DB, $name, $pwd)){
            header("location: ../login.php?err=incorrectLogin");
            exit();
        }
       
        session_start();

        $_SESSION['uid'] = getUIDByName($DB, $name);

        header("location: ../choosechar.php?msg=successfullLogin");

    }else{
        header("location: ../login.php");
        exit();
    }
?>
