<?php
    $pageName = basename($_SERVER['PHP_SELF']);
    echo '<p class="error">';
    switch($pageName)
    {
        case "admin.php":
            echo 'Access denied! You are not allowed to view this web page!</p>';
            break;
        case "login.php":
            echo 'Error, you are already logged in! Want to log out? <a href="logout.php">Click here!</a>';
    }
    echo '</p>';
?>