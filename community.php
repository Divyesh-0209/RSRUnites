<h3 class="content-head">Community Posts</h3>

<?php
$result = mysqli_query($con, "
    SELECT posts.id, posts.uid, posts.image, posts.caption, user.firstname, user.username
    FROM posts
    INNER JOIN user ON posts.uid = user.uid
    WHERE posts.adminper=1
    ORDER BY posts.id DESC
");
?>

<div class="posts">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="post card">
                <div class="post-header">
                    <div class="left-post-header">
                        <div class="user-icon"><?php echo strtoupper(substr($row['firstname'], 0, 1)); ?></div>
                        <div class="user-name"><?php echo htmlspecialchars($row['username']); ?></div>
                    </div>
                    <div class="right-post-header">
                        
                    </div>
                </div>

                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Post image" class="post-img community-post-img">
                <p class="caption"><?php echo htmlspecialchars($row['caption']); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="no-posts">No posts found.</p>
    <?php endif; ?>
</div>
