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
?>

    <head>

        <meta charset="utf-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>GB SNS</title>

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/blog-home.css" rel="stylesheet">

        <link rel="stylesheet" href="css/style.css">

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-dark bg-customs fixed-top">
            <div class="container">
                <a class="navbar-brand" href="main.php">GB SNS</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarResponsive"
                    aria-controls="navbarResponsive"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
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
                        <h5 class="card-header">Search</h5>
                        <div class="card-body">
                            <div class="input-group">
                                <form method='get' action='find.php'>
                                    <input type='text' name='keyword' tabindex='1'/>
                                    <input class="btn btn-custom" type='submit' tabindex='3' value='Go!'/>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Categories Widget -->
                    <div class="card my-4">
                        <h5 class="card-header">Live Question
                            <form method='get' action='upload.php'>
                                <input class="btn btn-custom" type='submit' tabindex='3' value='ASK Question'/>
                            </form>
                        </h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="our-services">
                                        <div class="container">
                                            <div class="row">

                                                <?php
                      $conn = sql();
                      $sql = "select ix, title, place, create_at from question where answer_ix is NULL order by ix desc";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        $count = 0;
                          while($row = $result->fetch_assoc()) {
                          echo '<div class="col-md-6">';
                          echo '<div class="service-box">';
                          echo '<div class="row">';
                          echo '<div class="col-12">';
                          echo "<h5><a href='./question_detail.php?ix=".$row["ix"]."'>".$row["title"]. "</a></h5>";
                          echo "<div class='btn-question'>" . $row["place"]."<br>";
                          echo $row["create_at"];
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                          $count += 1;
                          if ($count > 3) break;
                          }
                      }
                      ?>
                                                <a href='live_question_list.php' class="btn btn-custom">
                                                    Show more
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Side Widget -->
                    <div class="card my-4">
                        <h5 class="card-header">Archive Questions</h5>
                        <div class="card-body">
                            <?php

$conn = sql();

$sql = "select word, count from hashtag order by count desc ;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $count = 0;
    while($row = $result->fetch_assoc()) {
      $keyword = urlencode($row["word"]);
      echo '<div class="col-md-6">';
      echo '<div class="service-box">';
      echo '<div class="row">';
      echo '<div class="col-9">';
      echo "<h5><a href='./find.php?keyword=".$keyword."'>".$row["word"]."</a></h5>";
      echo "Count : " . $row["count"];
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    $count += 1;
    if ($count > 3) break;
    }
}
?>
                            <a href='solved_question_list.php' class="btn btn-custom">
                                Show more
                            </a>
                        </div>
                    </div>

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