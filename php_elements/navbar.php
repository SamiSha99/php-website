<?php

echo '<div class="topnav">';
echo '<a class="active" href="index.php">Home</a>';

if(isset($_SESSION['login_user']))
{
    if($_SESSION['type'] == "Admin") // admin 
        echo '<a href="admin.php">Admin page</a>';
    $name = $_SESSION['login_user'];
    echo '<a>Welcome ' . $name . '!</a><a> | </a><a href="logout.php">Log Out</a>';
}
else
{
    echo '<a href="login.php">Log In</a>';
}

echo'</div>';
if(basename($_SERVER['PHP_SELF']) != "login.php")
    echo'<img src="./assets/img/login-background.jpg" style="width: 100%; height: 150px; object-fit: cover;"/>';

?>