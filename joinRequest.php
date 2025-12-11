<?php include "connection.php";?>

<h3 class="content-head">Joinning Requests</h3>
<div class="request-container">
    <?php $studentrequests=mysqli_query($con, "SELECT * FROM user WHERE adminper IS NULL");
        if (mysqli_num_rows($studentrequests)==0) {
            ?><p class="no-request"><b>No joinning request found.</b></p><?php
        }else{
            while ($request=mysqli_fetch_assoc($studentrequests)) {
                ?>
                <div class="single-request">
                    <div class="left-request">
                        <h5 class="studname"><?php echo $request['username']; ?></h5>
                        <?php echo "<p class='stud-stream'>".$request['stream']." | ".$request['enroll']."</p>";?>
                    </div>
                    <div class="right-request">
                        <a href="accept.php?id=<?php echo $request['uid']?>"><button class="bttn request-accept">Accept</button></a>
                        <a href="reject.php?id=<?php echo $request['uid']?>"><button class="bttn request-reject">Reject</button></a>
                    </div>
                </div>
                <?php
            }
        }
    ?>
</div>
<?php mysqli_close($con);?>