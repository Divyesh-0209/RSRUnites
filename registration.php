<?php include "connection.php";
    session_start();

    $usernameInfo="";
    $passwordInfo="";
    $emailInfo="";
    $enrollInfo="";

    if(isset($_POST['user-registration-submit'])){

        $fname=$_POST['firstname'];
        $lname=$_POST['lastname'];
        $stream=$_POST['stream'];
        $enroll=$_POST['enroll'];
        $email=$_POST['email'];


        $enrollcount=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as cnt from user where enroll='$enroll'"));
        $isverified=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM user WHERE enroll='$enroll'"));
        if(($enrollcount['cnt']==0) || ($isverified['isverified'])==0){
            $usercount=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as cnt from user"));
            if($usercount['cnt']==0){
                mysqli_query($con,"INSERT INTO user(`uid`, `firstname`, `lastname`, `stream`, `enroll`, `email`) VALUES (1001, '$fname','$lname', '$stream', '$enroll', '$email')");
            }else{
                if (($isverified['isverified'])==0) {
                    # do nothing..
                }else{
                    mysqli_query($con,"INSERT INTO user(`firstname`, `lastname`, `stream`, `enroll`, `email`) VALUES ('$fname', '$lname', '$stream', '$enroll', '$email')");
                }
            }
            $token=bin2hex(random_bytes(50));
            mysqli_query($con, "update user set verifyToken='$token' where enroll='$enroll'");

            $verifyLink = "http://localhost/project1/verify.php?who=user&token=" . $token;
            $to=$email;
            $subject='Email verification';
            $message="
            <html>
                <head>
                    <title>Email Verification</title>
                </head>
                <body>
                    <p>Hello {$fname},</p>
                    <p>This email is sent you for your email verfication.</p>
                    <p>Please <a href='{$verifyLink}'>Click here</a> to verify.</p>
                    <br>
                    <p><i>Please don't reply to this mail.</i></p>
                    <br>
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
            $enrollInfo="Enrollment number already registered.";
            $_SESSION['isRegistered'] = true;
            $_SESSION['uid']=$isverified['uid'];
            header("Location: registration2.php");
            exit();
        }  
    }else{
        $fname="";
        $lname="";
        $stream="";
        $enroll="";
        $email="";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student-Registration</title>
    <link rel="stylesheet" href="style.css" class="css">
</head>
<body>
    <div class="form-page">
        <div class="form user-registration-container">
            <h1 class="form-head element-head">Registration</h1><br>
            <form id="user-registration-form" action="registration.php" method="POST" class="user-registration-form">
                <label for="firstname">First Name</label><br><input type="text" name="firstname" class="input" required>
                <br><br>
                <label for="lastname">Last Name</label><br><input type="text" name="lastname" class="input" required>
                <br><br>
                Stream<input type="radio" name="stream" id="BCA" value="BCA" required><label for="BCA">BCA</label>
                <input type="radio" name="stream" id="BBA" value="BBA" required><label for="BBA">BBA</label>
                <br><br>
                <label for="enroll">Enrollment Number</label><br><input type="text" name="enroll" class="input" required minlength="9" maxlength="9" 
                    pattern="[A-Za-z0-9]{9}" title="Enrollment number must be exactly 9 alphanumeric characters">
                <p class="warnnings"><?php echo htmlspecialchars($enrollInfo) ?></p>
                <br><br>
                <label for="email">Email</label><br><input type="email" name="email" class="input" required>
                <p class="warnnings"><?php echo htmlspecialchars($emailInfo) ?></p>
                <br><br>
                <button name="user-registration-submit" type="submit" class="bttn">SUBMIT</button>
                <br><br>
            </form> 
            <p class="change-password">Already registered? <a href="userLogin.php">Login</a></p>
            <br>
            <br>
        </div>
    </div>
    
</body>
</html>