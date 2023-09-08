<?php  
// INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES ('1', 'first note', 'letssss gooooo', current_timestamp());
$insert = false;
// Connect to the db
  $server = "localhost";
  $username = "root";
  $password = "";
  $database = "notes";

  // Create a connection
  $con = mysqli_connect($server, $username, $password);

  // Die if connection is not successful
  if(!$con){
    die("Failed to Connect: ". mysqli_connect_error());
  }
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $title = $_POST['title'];
    $description = $_POST['description'];

  // Sql query to be executed
  $sql = "INSERT INTO `notes`.`notes`(`title`, `description`) VALUES('$title', '$description')";
  $result = mysqli_query($con, $sql);

  // checking if the addition is successfull or not
  if($result){
    // echo "Record has been successfully added<br>";
    $insert = true;
  }
  else{
    echo "Encountered an Error ". mysqli_connect_error($con);
  }
  }
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  


  <title>iNotes - Notes taking made easy</title>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- <div class="container-fluid"> -->
    <a class="navbar-brand" href="#">PHP CRUD</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Dropdown
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li> -->
        <!-- <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                  </li> -->
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
    <!-- </div> -->
  </nav>

  <?php
  if($insert == true){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been added successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden = 'true'>&times;</span>
    </button>
  </div>";
  }
  ?>
  <div class="container my-5">
    <h2>Add a Note</h2>
    <form action="/php-CRUD-tutorial/index.php", method= "post">
      <div class="mb-3">
        <label for="title" class="form-label">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="desc" class="form-label">Note Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
  </div>

  <div class="container my-4">
    <table class="table" id= 'myTable'>
      <thead>
        <tr>
          <th scope="col">S no</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php  
            $sql = "SELECT * FROM `notes`.`notes`" ;
            $result = mysqli_query($con, $sql );
            while($row = mysqli_fetch_assoc($result)){
              echo "<tr>
              <th scope='row'>". $row['sno']. "</th>
              <td>". $row['title']. "</td>
              <td>". $row['description']. "</td>
              <td> Actions </td>
            </tr>";
              // echo $row['sno'] . ". Title ". $row['title']. " Desc is " . $row['description'];
            }
            ?>
        
        
      </tbody>
    </table>
  </div>
  <hr>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script>
    let table = new DataTable('#myTable');
  </script>

</body>

</html>