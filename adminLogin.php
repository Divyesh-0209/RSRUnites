<?php include "connection.php";

    $usernameInfo="";
    $passwordInfo="";
    $emailInfo="";
    
    if(isset($_POST['admin-login-submit'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $email=$_POST['email'];

        $result=mysqli_query($con,"select * from admin where username='$username'");
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            if ($password==$row['password']){
                if ($email==$row['email']) {
                    $token=bin2hex(random_bytes(50));
                    mysqli_query($con, "update admin set verifyToken='$token' where username='$username'");
        
                    $verifyLink="localhost/project1/verify.php?token=".$token;

                    $to=$email;
                    $subject='Email verification';
                    $message="
                    <html>
                        <head>
                            <title>Email Verification</title>
                        </head>
                        <body>
                            <p>Hello Admin,</p>
                            <p>This email is sent you for your email verfication.</p>
                            <p>Please <a href='{$verifyLink}'>Click here</a> to verify.</p>
                            <p>From RSR<b>U</b>NITES</p>
                        </body>
                    </html>";

                    $headers  = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                    if(mail($to, $subject, $message, $headers)){
                        $emailInfo="Verification email sent successfully! Please check your mail inbox.";
                    }else {
                        $emailInfo="Sending verification email failed. Try again.";
                    }
                }else {
                    $emailInfo="Invalid Email.! Write the email which is linked to admin account.";
                }
            }else {
                $passwordInfo="Invalid Password.! Try again.";
            }
        }else {
            $usernameInfo="Invalid Username.! Try again.";
        }
    }else{
        $username="";
        $password="";
        $email="";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Login</title>
    <link rel="stylesheet" href="style.css" class="css">
</head>
<body>
    <div class="form-page">
        <div class="form admin-login-container">
            <h1 class="form-head element-head">Admin Login</h1><br>
            <form id="admin-login-form" action="adminLogin.php" method="POST" class="admin-login-form">
                <label for="username">Username</label><br><input type="text" name="username" class="input" required>
                <p class="warnnings"><?php echo $usernameInfo;?></p>
                <br><br>
                <label for="password">Password</label><br><input type="password" name="password" class="input" required>
                <p class="warnnings"><?php echo $passwordInfo;?></p>
                <br><br>
                <label for="email">Email</label><br><input type="email" name="email" class="input" required>
                <p class="warnnings"><?php echo $emailInfo;?></p>
                <br><br>
                <button name="admin-login-submit" type="submit" class="bttn">SUBMIT</button>
                <br><br>
            </form>
            <p class="change-password">Forgot Password? <a href="changePass.php">Click Here</a></p>
            <br>
            <br>
        </div>
    </div>
    
    <script src="script.js"></script>

</body>
</html>