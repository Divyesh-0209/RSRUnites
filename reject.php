<?php
    include "connection.php";
    if (isset($_GET['id'])) {
        $uid=$_GET['id'];
        mysqli_query($con, "UPDATE user set adminper=-1 WHERE uid='$uid'");
        mysqli_query($con, "DELETE FROM user WHERE adminper=-1");
        header("Location: joinRequest.php?msg=Rejected");
        exit();
    }

    if (isset($_GET['pid'])) {
        $pid=$_GET['pid'];
        mysqli_query($con, "UPDATE posts set adminper=-1 WHERE id='$pid'");
        mysqli_query($con, "DELETE FROM posts WHERE adminper=-1");
        header("Location: adminCommon.php?msg=Rejected&page=postReq");
        exit();
    }
?>