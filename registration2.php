<?php
    include "connection.php";
    session_start();

    if (!isset($_SESSION['isRegistered']) || $_SESSION['isRegistered'] !== true) {
        header("Location: registration.php");
        exit();
    }

    $usernameInfo="";
    $confirmPasswordInfo="";

    if(isset($_POST['user-registration2-submit'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $confirmPassword=$_POST['confirmPassword'];
        $uid=$_SESSION['uid'];

        if(mysqli_num_rows(mysqli_query($con,"select * from user where uid='$uid'"))>0){
            if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM user WHERE username='$username'"))>0) {
                $usernameInfo="Username already Exists..!";
            }else {
                if ($password===$confirmPassword) {
                    mysqli_query($con, "UPDATE user SET username='$username', password='$password', isverified=1 WHERE uid='$uid'");
                    $_SESSION['username'] = $username;
                    $_SESSION['isLoggedIn']=true;
                    header("Location: index.php?msg=You+will+join+the+community+when+the+admin+accepts+your+request.");
                    exit();
                }else {
                    $confirmPasswordInfo="Confirm Password is not same.";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student-Registration2</title>
    <link rel="stylesheet" href="style.css" class="css">
</head>
<body>
    <div class="form-page">
        <div class="form user-registration2-container">
            <h1 class="form-head element-head">Username & Password</h1><br>
            <form id="user-registration2-form" action="registration2.php" method="POST" class="user-registration2-form">
                <label for="username">Username</label><br><input type="text" name="username" class="input" required>
                <p class="warnnings"><?php echo $usernameInfo;?></p>
                <br><br>
                <label for="password">Password</label><br><input type="password" name="password" class="input" required>
                <br><br>
                <label for="confirmPassword">Confirm Password</label><br><input type="password" name="confirmPassword" class="input" required>
                <p class="warnnings"><?php echo $confirmPasswordInfo;?></p>
                <br><br>
                <button name="user-registration2-submit" type="submit" class="bttn">SUBMIT</button>
                <br><br>
            </form> 
            <br>
            <br>
        </div>
    </div>
    
</body>
</html>