<?php

if (isset($_POST['submit'])) {
    $caption = mysqli_real_escape_string($con, $_POST['caption']);
    $image = $_FILES['image'];

    // Check file
    $imageName = $image['name'];
    $imageTmp = $image['tmp_name'];
    $imageSize = $image['size'];

    $ext = pathinfo($imageName, PATHINFO_EXTENSION);
    $allowed = ['jpg','jpeg','png','gif'];

    if (in_array(strtolower($ext), $allowed)) {
        $newName = uniqid() . "." . $ext;
        $uploadPath = "uploads/" . $newName;
        $uid=$_SESSION['uid'];
        if (move_uploaded_file($imageTmp, $uploadPath)) {
            $sql = "INSERT INTO posts (uid, image, caption) VALUES ( '$uid', '$newName', '$caption')";
            if (mysqli_query($con, $sql)) {
                echo "Post uploaded successfully!";
            } else {
                echo "Database error: " . mysqli_error($con);
            }
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "Only JPG, PNG, GIF allowed.";
    }
}

?>

    <h3 class="content-head">Form For Posting</h3>

    <div class="posts">
        <div class="upload-container">
            <form action="userCommon.php?page=post" method="POST" enctype="multipart/form-data" id="postingForm" class="post-form">
                <!-- Image preview box -->
                <div class="img-part">
                    <label for="imageUpload" class="image-box" id="imageBox">
                        <span id="selectText">Select Image</span>
                        <img id="previewImage" src="" alt="">
                    </label>
                    <input type="file" id="imageUpload" name="image" accept="image/*" hidden>
                </div>

                <!-- Caption -->
                <div class="cap-submit-part">
                    <textarea id="caption" name="caption" class="input" rows=10 placeholder="Write a caption..."></textarea>
                    <div class="buttons">
                        <button form="postingForm" id="backBtn" class="bttn" type="button">Back</button>
                        <button form="postingForm" id="uploadBtn" class="bttn" type="submit" name="submit">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    const imageUpload = document.getElementById("imageUpload");
    const previewImage = document.getElementById("previewImage");
    const selectText = document.getElementById("selectText");

    document.getElementById("imageBox").addEventListener("click", () => {
        imageUpload.click();
    });

    imageUpload.addEventListener("change", () => {
        const file = imageUpload.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                previewImage.src = e.target.result;
                previewImage.style.display = "block";
                selectText.style.display = "none";
            };
            reader.readAsDataURL(file);
        }
    });

    // Optional: back button resets
    document.getElementById("backBtn").addEventListener("click", () => {
        previewImage.src = "";
        previewImage.style.display = "none";
        selectText.style.display = "block";
        imageUpload.value = "";
        document.getElementById("caption").value = "";
    });
    </script>

