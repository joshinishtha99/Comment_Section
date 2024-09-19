<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Comment Section</title>
  </head>
  <body>
<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $comment_new = str_replace("'", '', $comment);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "comment_section";

    $conn = mysqli_connect($servername, $username, $password, $database); // establishing connection

    if(!$conn){
      die("Sorry we failed to connect: " . mysqli_connect_error()); // exits program if executed
    }
    else{   // Submit to a database
      $sql = "INSERT INTO `comment_section` (`fullname`, `comment`, `created_at`) VALUES ('$name', '$comment_new', NOW());";
      $result = mysqli_query($conn, $sql);

      if($result){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your comment has been submitted.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      else{
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> Your comment has not been submitted due to server error.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        echo mysqli_error($conn);
      }
    }
  }

  echo '<h1 align="center" class="mt-1">Comments</h1>';
  echo '<hr>';

  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "comment_section";

  $conn = mysqli_connect($servername, $username, $password, $database); // establishing connection

  if(!$conn){
    die("Sorry we failed to connect: " . mysqli_connect_error()); // exits program if executed
  }

  // Selecting DATA
  $sql = "SELECT * FROM `comment_section`";
  $result = mysqli_query($conn, $sql);

  // Display the rows returned by SQL Query
  while($row = mysqli_fetch_assoc($result)){
    echo '<div class="container mt-1">
    <div class="card" align="center" style="width:81rem;">
      <div class="card-body" align="left">
        <h5 class="card-title">'.$row['fullname'].' <small class="text-muted">'.$row['created_at'].'</small></h5>
        <p class="card-text">'.$row['comment']. '</p>
      </div>
    </div>
    </div><br>';
  }

  echo '<hr>';
?>

  <!-- Form Layout, for adding name and comment -->
  <div class="container mt-3">
    <h2>Add Comment</h2>
    <form action="/akshat/addcomment.php" method="post">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="name" required>
      </div>
      <div class="mb-3">
        <label for="comment" class="form-label">Comment</label>
        <textarea name="comment" class="form-control" id="comment" aria-describedby="emailHelp" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <br>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
  </body>
</html>
