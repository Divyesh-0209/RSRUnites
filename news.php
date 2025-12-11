<?php
include "connection.php";

// ADD News
if (isset($_POST['addNews'])) {
    $headline = mysqli_real_escape_string($con, $_POST['headline']);
    $admin_id = $_SESSION['aid']; // assuming stored in session
    $query = "INSERT INTO news (headline, admin_id, date) VALUES ('$headline', '$admin_id', NOW())";
    mysqli_query($con, $query);
    header("Location: adminCommon.php?msg=News+Added+Successfully&page=news");
    exit();
}

// DELETE News
if (isset($_GET['delete'])) {
    $nid = intval($_GET['delete']);
    mysqli_query($con, "DELETE FROM news WHERE nid=$nid");
    header("Location: adminCommon.php?msg=News+Deleted&page=news");
    exit();
}

// EDIT (Update) News
if (isset($_POST['updateNews'])) {
    $nid = intval($_POST['nid']);
    $headline = mysqli_real_escape_string($con, $_POST['headline']);
    mysqli_query($con, "UPDATE news SET headline='$headline' WHERE nid=$nid");
    header("Location: adminCommon.php?msg=News+Updated&page=news");
    exit();
}

// Fetch all news
$result = mysqli_query($con, "SELECT * FROM news ORDER BY date DESC");
?>

<div class="admin-news-container">
    <h2>News Management</h2>

    <!-- Add News Form -->
    <form method="POST" class="add-news-form">
        <input type="text" name="headline" placeholder="Enter news headline" required>
        <button type="submit" name="addNews">Add News</button>
    </form>

    <!-- News Table -->
    <table class="news-table">
        <tr>
            <th>Sr. No.</th>
            <th>Headline</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>

        <?php 
            $sr=1;
            while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $sr; ?></td>
                <td>
                    <form method="POST" class="edit-form">
                        <input type="hidden" name="nid" value="<?php echo $row['nid']; ?>">
                        <input type="text" name="headline" value="<?php echo htmlspecialchars($row['headline']); ?>">
                        <button type="submit" name="updateNews" class="action-btn edit-btn">Save</button>
                    </form>
                </td>
                <td><?php echo $row['date']; ?></td>
                <td>
                    <a href="news.php?delete=<?php echo $row['nid']; ?>" >
                        <button type="button" class="action-btn delete-btn">Delete</button>
                    </a>
                </td>
            </tr>
        <?php $sr=$sr+1;
        endwhile; ?>
    </table>
</div>