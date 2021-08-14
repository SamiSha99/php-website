<?php
   $con = mysqli_connect('localhost', 'root', '', 'bookstore') or die("no connection");
   
   $error = "";
   if (!$con) 
      echo "No Connection";
   session_start();
   if(isset($_GET['login']))
   {
      $myusername = $_GET['username'];
      $mypassword = $_GET['password']; 

      $sql = "SELECT * FROM users WHERE name = '$myusername' AND password = '$mypassword'";
         
      $result = mysqli_query($con, $sql);
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count == 1) {
         $row = mysqli_fetch_array($result);
         
         $_SESSION['login_user'] = $myusername;
         $_SESSION['type'] = $row['type'];;
         
         header("location: index.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      <link rel="stylesheet" type="text/css" href="assets/style.css">
      <link rel="stylesheet" type="text/css" href="assets/login.css">
   </head>
   <?php include 'php_elements/navbar.php';
      
         if(isset($_SESSION['type']) || isset($_SESSION['type']))
         {
            include 'php_elements/error.php';
            die("");
         }
      ?>
   <body class="login-body"> 
      <div class="login">
         <div class="outer-border">
            <div class="login-cell"><b>Login</b><br/> <p style="font-size:12px">To access the Library, please Log In!</p></div>
            <div class="login-form">
               <form>
                  <div>
                     <label class="label-input-name">Name:</label><br/><input class="login-input" type = "text" name = "username" /><br /><br />
                  </div>
                  <div>
                     <label class="label-input-name">Password:</label><br/><input class="login-input" type = "password" name = "password" /><br/><br />
                  </div>
                  <input class="login-button" type = "submit" name = "login" value = " Log In "/>
               </form>
               <div class="login-error"><?php echo $error; ?></div>
            </div>
         </div>
      </div>   
   </body>
</html>