<?php
include "connection.php";
?>

<section class="homepage">
    <div class="welcome-container">
        <div class="wel-content">
            <span class="rank">
                <h1 id="rank-no">1</h1>
                <p id="st">st</p>
            </span>
            <span class="wel-span">
                <p id="wel-pre">WELCOME TO THE</p>
                <p id="wel-pre">PRIVATE UNIVERSITY OF VAPI</p>
            </span>
            <p id="content">Rajju Shroff ROFEL University is a State Private University, established by Govt. of Gujarat vide Gujarat Private Universities (Amendment) Act, 2023 further amending the Gujarat Private Universities Act No. 8 of 2009 and approved under section 2(f) of UGC Act 1956.</p>
        </div>
    </div>
    <div class="news-container">
        <h1 class="news-heading">NEWS</h1>
        <div class="news">
            <div class="do-you-know">
                <h2 class="dyk-head">DO YOU KNOW?</h2>
            </div>
            <marquee width="100%" height="80%" behavior="scroll" direction="up" scrollamount="6" class="headlines" onmouseover="this.stop();" onmouseout="this.start();">
                <?php
                    $headlines = "SELECT headline FROM news ORDER BY date DESC";
                    $news = mysqli_query($con, $headlines);
                    if (mysqli_num_rows($news) > 0) {
                        while ($row = mysqli_fetch_assoc($news)) {
                            echo "• " . htmlspecialchars($row['headline']) . "<br><br>";
                        }
                    } else {
                        echo "No latest news available.";
                    }
                ?>
            </marquee>
        </div>
    </div>
    <div class="about-gallery">
        <div class="about-us">
            <h1 class="element-head about-head">About Us</h1>
            <div class="about-content">
                <p>Rajju Shroff ROFEL University is a State Private University, established by Govt. of Gujarat vide Gujarat Private Universities (Amendment) Act, 2023 further amending the Gujarat Private Universities Act No. 8 of 2009 and approved under section 2(f) of UGC Act 1956.</p>
                <br>
                <p>Rajju Shroff ROFEL University, Vapi is committed to promote academic and industrial activities. Nurtured with passion and powered by intellect, it ignites in its scholars the spirit of innovation, dynamism, professionalism to build a brighter and successful career from them.</p>
                <br>
                <!-- <a href="about.php" class="read-more">READ MORE  ></a> -->
            </div>
        </div>
        <div class="gallery">
            <img class="gallery-img img1" src="RSRU logo.png" alt="ABCD">
            <img class="gallery-img img2" src="college1.jpeg" alt="">
            <h2 class="element-head gallery-head"> G A L L E R Y </h2>
        </div>
    </div>
    <div class="events-container">
        <div class="event-head">
            <h3 id=h1>RSR<b style="font-size: 6rem; color: rgb(230, 165, 50);">U</b></h3>
            <h1 id=h2><b style="font-size: 13rem; color: rgb(30, 70, 138);">U</b>NITES</h1><br><br><br><br>
            <p class="community-desc">Join the RSRU college community NOW..!! </p>
            <button class="bttn">Join Now</button>
        </div>
    </div>
</section>