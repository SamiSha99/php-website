<!DOCTYPE html>
<?php 

  $con = mysqli_connect('localhost', 'root', '', 'bookstore') or die("no connection");
    
  $sqlInputBookResult = "";
  $sqlInputUserResult = "";
  if (!$con) 
    echo "No Connection";
  
  session_start();
  
  $result = NULL;
  if(isset($_GET['search_book']))
  {
    $bookName = $_GET['bookName'];
    $id = $_GET['bookID']; 
    $author = $_GET['authorName'];

    $sql =  "SELECT * FROM books WHERE name ='$bookName' OR id='$id' OR author='$author'";
    $result = mysqli_query($con, $sql);
  }

?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css">
  <!-- Forces CSS to load before PHP initialize first, 
  fixes the bug where tables won't apply the CSS from echo cast -->
  <link rel="stylesheet" href="./assets/style.css?v=<?php echo time(); ?>"> 
  <link rel="stylesheet" href="./assets/admin.css">
</head>

<body>
  <?php include 'php_elements/navbar.php';?>
  <div class="body">
    <h1>Welcome to the local Library!</h1>

    <p>We have an archive of books of all things you could imagine! From history to biology to physics and even to folklore!</p>

    <div><b>Search the library!</b></div>
      <div>
        <form id="form_block">
          <div class="library-input">
            <label>Book Name:     </label><input id="inputBookName" type = "text" name = "bookName" />
          </div>
          <div class="library-input">
            <label>Book ID:     </label><input id="inputID" type = "text" name = "bookID" />
          </div>
          <div class="library-input">
            <label>Author:     </label><input id="inputAutor" type = "text" name = "authorName" />
          </div>
          <div class="form-button">
            <input class="admin-button" id="inputSubmit" type = "submit" name = "search_book" value = "Search Library"/>
          </div>
        </form>
        <div class="admin-error"><?php echo $sqlInputUserResult; ?></div>
      </div>
      <?php
      if($result != NULL)
      {
        echo '<h1>Results:</h1>';
        echo '<table>';
        echo '<tr>
                <th>Book Name</th>
                <th>ID</th>
                <th>Author</th>
              </tr>';
        while ($row = mysqli_fetch_array($result))
        {
          echo '<tr>
                  <td>' . $row['name'] . '</td>
                  <td>' . $row['id'] . '</td>
                  <td>' . $row['author'] . '</td>
                </tr>';
        }
        echo '</table>';
      }
      ?>
   </div>
</body>
</html>
