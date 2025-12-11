<?php
    include "connection.php";
    if (isset($_GET['id'])) {
        $uid=$_GET['id'];
        mysqli_query($con, "UPDATE user set adminper=1 WHERE uid='$uid'");
        header("Location: adminCommon.php?msg=Accepted&page=requests");
        exit();
    }
    if (isset($_GET['pid'])) {
        $pid=$_GET['pid'];
        mysqli_query($con, "UPDATE posts set adminper=1 WHERE id='$pid'");
        header("Location: adminCommon.php?msg=Accepted&page=postReq");
        exit();
    }
?>