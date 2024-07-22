<?php
setcookie("user", "Sonoo",
time() - 86400);
?>
<html>
<body>
    <?php
    if (isset($_COOKIE["user"])) {
        $user = $_COOKIE["user"];
        echo "Welcome $user";
        
    } else {
        echo "
        <form action='cookie.php' method='post'>
            <label for='user'>Enter your name:</label>

            <input type='text' name='user' placeholder='Enter user'>
            <input type='submit' value='Submit'>
        </form>
            ";
            
    }
    ?>
</body>
</html>