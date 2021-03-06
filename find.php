<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include 'sql.php';

if(!isset($_SESSION['user_id'])) {
	echo "<meta http-equiv='refresh' content='0;url=login.php'>";
	exit;
}
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// keyword가 입력되지 않았을 때,
if($_GET['keyword'] == "") {
	print "<script language=javascript> alert('검색어를 입력하세요.'); location.replace('./main.php'); </script>";
	exit;
}

$conn = sql();
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>GB SNS</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/blog-home.css" rel="stylesheet">

  <link href="css/style.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-dark bg-customs fixed-top">
    <div class="container">
      <a class="navbar-brand" href="main.php">GB SNS</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="main.php">Home
              <span class="sr-only">(current)</span>
            </a>
            <a class="nav-link" href="logout.php">Logout
              <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
	  
    <div class="row">
      <!-- Sidebar Widgets Column -->
        <div class="col-md-12">
        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Live Question</h5>
          <div class="card-body">
          <?php
          $conn = sql();
          $sql = "select ix, title, contents, create_at, place from question where answer_ix is NULL and (title like  \"%".$_GET["keyword"]."%\" or contents like \"%".$_GET["keyword"]."%\") order by ix desc";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            $count = 0;
              while($row = $result->fetch_assoc()) {
              echo "<a href='./question_detail.php?ix=".$row["ix"]."'>title : ".$row["title"]. " -- palce : " . $row["place"]."-- Time :".$row["create_at"]."</a><br>";
              }
          }
          ?>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
  <!-- Page Content -->
  <div class="container">
	  
    <div class="row">
      <!-- Sidebar Widgets Column -->
        <div class="col-md-12">
        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Archive Questions</h5>
          <div class="card-body">
          <?php
          $conn = sql();
          $sql = "select ix, title, contents, create_at, place from question where answer_ix is not null and (title like  \"%".$_GET["keyword"]."%\" or contents like \"%".$_GET["keyword"]."%\") order by ix desc";
          $result = $conn->query($sql);
          $conn->close();
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
              echo "<a href='./solved_question_detail.php?ix=".$row["ix"]."'>title : ".$row["title"]. " -- palce : " . $row["place"]."-- Time :".$row["create_at"]."</a><br>";
              }
          }
          ?>
          </div>
          
        </div>
        <a href='main.php' class="btn btn-custom service-gap">
              Back
              </a>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-bottom">
    <div class="container">
    <hr class="my-4">
      <p class="m-0 text-center text-black">Copyright &copy; 우리함께외국인친해조</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>