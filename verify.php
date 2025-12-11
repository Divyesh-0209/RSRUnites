<?php
    include "connection.php";
    session_start();
    
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        if(isset($_GET['who']) && $_GET['who'] === 'user'){
            $table='user';
        }else{
            $table='admin';
        }
        $query = "SELECT * FROM `$table` WHERE verifyToken='$token' LIMIT 1";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) { 
            $row = mysqli_fetch_assoc($result);

            $update = "UPDATE `$table` SET verifyToken=NULL WHERE verifyToken='$token'";
            if (mysqli_query($con, $update)) {
                if ($table==='user') {
                    $_SESSION['uid'] = $row['uid'];
                    $_SESSION['isRegistered']=true;
                    header('Location: registration2.php');
                    exit();
                }else{
                    $_SESSION['aid'] = $row['aid'];
                    $_SESSION['adminUsername'] = $row['username'];
                    $_SESSION['isAdLoggedIn'] = true;
                    header('Location: adminCommon.php');
                    exit();
                }
            } else {
                echo "<h2>Something went wrong while updating.</h2>";
            }
        } else {
            echo "<h2>Invalid or expired token.</h2>";
        }
    } else {
        echo "<h2>No token provided.</h2>";
    }
?>