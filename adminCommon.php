<?php
    include "connection.php";
    session_start();

    if (!isset($_SESSION['isAdLoggedIn']) || $_SESSION['isAdLoggedIn'] !== true) {
        header("Location: admnLogin.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin-Page</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "navbar.php";  ?>

    <!-- Sidebar -->    
    <div class="panel-page">
        <div class="left-side">
            <div class="sidebar">
                <div class="menu"><b>MENU</b></div>
                <a href="adminCommon.php?page=home" class="menu-bttn" >Homepage</a>
                <a href="adminCommon.php?page=requests" class="menu-bttn" >Join Requests</a>
                <a href="adminCommon.php?page=postReq" class="menu-bttn" >Post's Request</a>
                <a href="adminCommon.php?page=community" class="menu-bttn" >Community</a>
                <a href="adminCommon.php?page=news" class="menu-bttn" >News</a>
                <a href="adminCommon.php?page=profile" class="menu-bttn" >Profile</a>
                <a href="adminCommon.php?page=settings" class="menu-bttn" >Settings</a>
            </div>
        </div>

        <!-- Top bar -->
        <div class="right-side">
            <div class="topbar">
                <div class="username"><h1><?php echo $_SESSION['adminUsername']; ?></h1></div>
                <a href="logout.php?admin=1"><button class="bttn logout">Logout</button></a>
            </div>

            <!-- Content area -->
            <div class="content">
                <?php
                    if (isset($_GET['page'])) {
                        $page=$_GET['page'];
                        if ($page=="home")include "homepage.php";
                        elseif ($page == "requests") include "joinRequest.php";
                        elseif ($page == "postReq") include "postRequest.php";
                        elseif ($page == "community") include "community.php";
                        elseif ($page == "news") include "news.php";
                        elseif ($page == "profile") include "profile.php";
                        elseif ($page == "settings") include "settings.php";
                    }else {
                        include "homepage.php";
                    }
                ?>
                <?php include "message.php"; ?>

            </div>
        </div>
    </div>
    <?php
        
    ?>

    <script src="script.js"></script>
</body>
</html>
