<?php
    include "connection.php";
    session_start();

    $usernameInfo="";
    $passwordInfo="";

    if(isset($_POST['user-login-submit'])){
        $username=$_POST['username'];
        $password=$_POST['password'];

        if(mysqli_num_rows(mysqli_query($con,"select * from user where username='$username'"))>0){
            $result=mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE username='$username'"));
            if ($result['isverified']==1) {
                if($password===$result['password']){
                    $_SESSION['uid']=$result['uid'];
                    $_SESSION['username']=$result['username'];
                    $_SESSION['isLoggedIn']=true;

                    header("Location: userCommon.php");
                    exit();
                }else {
                    $passwordInfo="Invalid Password.!";
                }
            }else {
                header("Location: registration.php");
                exit();
            }

        }else{
            $usernameInfo="Invalid Username.!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student-Login</title>
    <link rel="stylesheet" href="style.css" class="css">
</head>
<body>
    <div class="form-page">
        <div class="form user-login-container">
            <h1 class="form-head element-head">Login</h1><br>
            <form id="user-login-form" action="userLogin.php" method="POST" class="user-login-form">
                <label for="username">Username</label><br><input type="text" name="username" class="input" required>
                <p class="warnnings"><?php echo $usernameInfo;?></p>
                <br><br>
                <label for="password">Password</label><br><input type="password" name="password" class="input" required>
                <p class="warnnings"><?php echo $passwordInfo;?></p>
                <br><br>
                <button name="user-login-submit" type="submit" class="bttn">SUBMIT</button>
                <br><br>
            </form>
            <p class="change-password">Create Account. <a href="registration.php">Click Here</a></p>
            <p class="change-password">Forgot Password? <a href="changePass.php">Click Here</a></p>
            <br>
            <br>
        </div>
    </div>
    
</body>
</html>