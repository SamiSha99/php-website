<?php 
  $con = mysqli_connect('localhost', 'root', '', 'bookstore') or die("no connection");
    
  $sqlInputBookResult = "";
  $sqlInputUserResult = "";
  if (!$con) 
      echo "No Connection";
  session_start();
  if(isset($_GET['add_book']))
  {
      $bookName = $_GET['bookName'];
      $bookID = intval($_GET['bookID']); 
      $author = $_GET['author']; 


      $sql =  "INSERT INTO `books` (`name` ,`id` ,`author`) VALUES ('$bookName', '$bookID', '$author')";
      $sqlInputBookResult = $con->query($sql) ? "Book was successfully added!" : "Failed to add a user, check your inputs!";
  }

  if(isset($_GET['add_user']))
  {
      $userName = $_GET['userName'];
      $id = $_GET['userID']; 
      $password = $_GET['userPassword'];
      $userType = "User";

      $sql =  "INSERT INTO `users` (`name` ,`password` ,`id` ,`type`) VALUES ('$userName', '$password', '$id', '$userType')";
      $sqlInputUserResult = $con->query($sql) ? "User was successfully added!" : "Failed to add a book, check your inputs!";
  }
  
?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="assets/style.css">
  <link rel="stylesheet" type="text/css" href="assets/admin.css">
</head>

<body>
<?php include 'php_elements/navbar.php';?>

<div class="body">

<?php
  // Permissions: Admins are the only ones allowed to access this.
  if(!isset($_SESSION['login_user']) || isset($_SESSION['type']) && $_SESSION['type'] != "Admin")
  {
    include 'php_elements/error.php';
    die("");
  }
?>
  <p>Welcome to the Admin page!</p>
  
  <div>
    <div class="outer-border">
      <div><b>Add a book:</b></div>
        <div class="admin-form">
          <form>
            <div class="admin-input">
              <label>Book Name:</label><input type = "text" name = "bookName" />
            </div>
            <div class="admin-input">
              <label>Book ID:</label><input type = "text" name = "bookID" />
            </div>
            <div class="admin-input">
              <label>Author:</label><input type = "text" name = "author" />
            </div>
            <div class="admin-input">
              <input class="admin-button" type = "submit" name = "add_book" value = "Add Book"/>
            </div>
          </form>
          <div class="admin-error"><?php echo $sqlInputBookResult; ?></div>
        </div>
    </div>
    <br/><br/><br/>
    <div><b>Add a user:</b></div>
        <div class="admin-form">
          <form>
            <div class="admin-input">
              <label>User Name:</label><input type = "text" name = "userName" />
            </div>
            <div class="admin-input">
              <label>User ID:</label><input type = "text" name = "userID" />
            </div>
            <div class="admin-input">
              <label>Password:</label><input type = "text" name = "userPassword" />
            </div>
            <div class="admin-input">
              <input class="admin-button" type = "submit" name = "add_user" value = "Add User"/>
            </div>
          </form>
          <div class="admin-error"><?php echo $sqlInputUserResult; ?></div>
        </div>
    </div>

  </div>   
</div>

</body>
</html>
