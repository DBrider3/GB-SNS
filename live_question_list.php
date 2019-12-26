<!DOCTYPE html>
<html lang="ko">

<?php
session_start();
include 'sql.php';
if(!isset($_SESSION['user_id'])) {
   echo "<meta http-equiv='refresh' content='0;url=login.php'>";
   exit;
}
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$chk1="collapse";
$chk2="collapse";
if(isset($_GET['idx'])){

	$offset = $_GET['idx'];
	$offset = ($offset-1) * 5;
}
else{
	$offset = 0;
}

if(isset($_GET['idx2'])){

	$offset2 = $_GET['idx2'];
	$offset2 = ($offset2-1) * 5;
}
else{
	$offset2 = 0;
}

if($_GET['idx']>=1){
 $chk1 = "collapse show"; 
} 

if($_GET['idx2']>=1){
  $chk2 = "collapse show"; 
}
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
        <div class="col-md-12">

            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">Live Question</h5>
                <div class="card-body">

                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button
                                        class="btn"
                                        data-toggle="collapse"
                                        data-target="#collapseOne"
                                        aria-expanded="true"
                                        aria-controls="collapseOne">
                                        Live Question
                                    </button>
                                </h5>
                            </div>

                            <div
                                id="collapseOne"
                                class="<?php echo $chk1;?>"
                                aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body">

                                    <?php
					$conn = sql();
					$sql = "select ix, title, place, create_at from question where answer_ix is NULL order by ix desc Limit 5 OFFSET ".$offset."";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
                            $engTitle = $row["title"];
                            echo "<pre><a href='./question_detail.php?ix=".$row["ix"]."'><h5 style='margin-bottom: 0;line-height: 1;'>".$engTitle. "	</h5><br>" . $row["place"]."    ".$row["create_at"]."</a></pre>";
						}
					}
					?>
                                </div>
                                <li style="list-style:none; text-align:center;">
                                    <?php
					$sql = "select ix from question where answer_ix is NULL order by ix desc";
					$result = $conn->query($sql);
					$cnt = $result->num_rows / 5;
                    $i = 1;
                    if($result->num_rows%5===0) $cnt--;
					while($i<=($cnt+1)){
						echo "<a href='./live_question_list.php?idx=".$i."'>".$i." </a>";
						$i++;
					}

					?>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="card service-gap">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button
                                    class="btn collapsed"
                                    data-toggle="collapse"
                                    data-target="#collapseTwo"
                                    aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    Sort by place
                                </button>
                            </h5>
                        </div>
                        <div
                            id="collapseTwo"
                            class="<?php echo $chk2;?>"
                            aria-labelledby="headingTwo"
                            data-parent="#accordion">
                            <div class="card-body">

                                <?php
			$conn = sql();
			$sql = "select DISTINCT place from question where answer_ix is NULL Limit 5 OFFSET ".$offset2."";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				$count = 0;
				while($row = $result->fetch_assoc()) {
					echo "<pre><a href='./find_by_place.php?place=".$row["place"]."'>".$row["place"]."</a></pre>";
					$count += 1;
				}
			}
			?>

                                <li style="list-style:none; text-align:center;">
                                    <?php
			$sql = "select DISTINCT place from question where answer_ix is NULL";
			$result = $conn->query($sql);
			$cnt = $result->num_rows / 5;
            $i = 1;
            if($result->num_rows%5===0) $cnt--;
			while($i<=($cnt+1)){
				echo "<a href='./live_question_list.php?idx2=".$i."'>".$i." </a>";
				$i++;
			}

			?>
                                </li>
                            </div>
                        </div>
                        
                    </div>

                    <a href='main.php' class="btn btn-custom service-gap">
                        back
                    </a>
                
                    
            </div>

        </div>
    </div>

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