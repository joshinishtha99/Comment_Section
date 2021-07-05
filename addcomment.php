<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Contact Us</title>
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

    $conn = mysqli_connect($servername,$username,$password,$database); // establishing connection

    if(!$conn){
      die("Sorry we failed  to connect: " . mysqli_connect_error()); // exits program if executed
    }
    else{   //Submit to a database
    $sql = "INSERT INTO `comment_section` (`fullname`, `comment`) VALUES ('$name', '$comment_new');";
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

 $conn = mysqli_connect($servername,$username,$password,$database); // establishing connection

 if(!$conn){
   die("Sorry we failed  to connect: " . mysqli_connect_error()); // exits program if executed
 }

 //selecting DATA
 $sql = "SELECT * FROM `comment_section`";
 $result = mysqli_query($conn, $sql);

 //find number of records returned
 $num = mysqli_num_rows($result);

 //Display the rows returned by SQL Query
 while($row = mysqli_fetch_assoc($result)){
   echo '<div class="mt-1" align="center">
   <div class="card" style="width: 18rem;">
 <div class="card-body">
   <h5 class="card-title">'.$row['fullname'].'</h5>
   <p class="card-text">'.$row['comment']. '</p>
 </div>
</div>
</div><br>';
 }

 echo '<hr>';
  ?>
  <div class = "container mt-3">
    <h2>Add Comment</h2>
    <form action="/akshat/addcomment.php" method="post">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" id="name">
  </div>
  <div class="mb-3">
    <label for="comment" class="form-label">Comment</label>
    <textarea type="comment" name="comment" class="form-control" id="comment" aria-describedby="emailHelp"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </div>
  <br>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
  </body>
</html>
