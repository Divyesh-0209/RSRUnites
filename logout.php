<?php
session_start();

if(isset($_GET['admin'])){
    header("Location: adminLogin.php");
    exit();
}elseif (isset($_GET['user'])) {
    header("Location: userLogin.php");
    exit();
}else{
}
session_unset();
session_destroy();
?>