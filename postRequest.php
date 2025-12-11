<h3 class="content-head">Post's Requests</h3>

<?php
    include "connection.php";

    $result = mysqli_query($con, "
        SELECT posts.id, posts.uid, posts.image, posts.caption, user.firstname, user.lastname
        FROM posts
        INNER JOIN user ON posts.uid = user.uid
        WHERE posts.adminper IS NULL
        ORDER BY posts.id DESC
    ");
?>

<div class="posts">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="post request-card">
                <div class="post-header">
                    <div class="left-post-header">
                        <div class="user-icon"><?php echo strtoupper(substr($row['firstname'], 0, 1)); ?></div>
                        <div class="user-name"><?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?></div>
                    </div>
                    <div class="right-post-header">
                        <a href="accept.php?pid=<?php echo $row['id']?>"><button class="bttn request-accept">Accept</button></a>
                        <a href="reject.php?pid=<?php echo $row['id']?>"><button class="bttn request-reject">Reject</button></a>
                    </div>
                </div>

                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Post image" class="post-img">
                <p class="caption"><?php echo htmlspecialchars($row['caption']); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="no-posts">No pending posts found.</p>
    <?php endif; ?>
</div>