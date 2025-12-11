<div class="message">
    <?php
        if(isset($_GET['msg'])){
            $msg=$_GET['msg'];
            echo htmlspecialchars($msg);
            ?>
            <script>
            window.addEventListener('DOMContentLoaded', () => {
            messageDisplay();});</script>
            <?php
        }
    ?>
</div>

<script>
    const message = document.querySelector('.message');
    function messageDisplay() {
        message.style.bottom='5vh';
        message.style.opacity="1";
        setTimeout(() => {
            message.style.bottom='-5vh';
            message.style.opacity="0";
        }, 3000);
    }
</script>