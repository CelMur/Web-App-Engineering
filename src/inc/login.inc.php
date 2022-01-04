<?php
    if(isset($_POST)){
        $uid = addslashes($_POST["uid"]);
        $pwd =  addslashes($_POST["pwd"]);
        
        require_once("db/dhb.inc.php");
        require_once("db/db.user.uidExists.inc.php");
        require_once("db/db.user.verifyPassword.inc.php");
        require_once("pwd.inc.php");
        require_once("login-functions.inc.php");

        if(emptyInputLogin($uid, $pwd) !== false){
            header("location: ../login.php?err=emptyInput");
            exit();
        }

        if(!verifyLogin($DB_Spellbook, $uid, $pwd)){
            header("location: ../login.php?err=incorrectLogin");
            exit();
        }
        
        $_SESSION['current_user_id'] = '';
        header("location: ../choosechar.php?msg=successfullLogin");

    }else{
        header("location: ../login.php");
        exit();
    }
?>