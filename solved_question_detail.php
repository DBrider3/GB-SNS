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


// get 방식으로 전달받은 ix 게시글을 선택하여 출력
$conn = sql();
$sql = "select * from question where ix = ".$_GET["ix"].";";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// 게시글 내용 저장하여 해시태그 파싱
$contents = $row['contents'];
echo "<script>alert($contents);</script>";
$strTok =explode(' ' , $contents); // 띄어쓰기 단위로 문자열 슬라이스
$cnt = count($strTok);			   // 총 어절 수
$result_contents = "";
for($i = 0 ; $i < $cnt ; $i++){
	if(empty($strTok[$i])) continue;	
	if( $strTok[$i][0] == '#') {
                $word = $strTok[$i];
                $sql = "SELECT * from hashtag where word = \"$word\"";
                $res = $conn->query($sql);
                // 테이블에 존재하지 않으면 해시태그 삽입
                if($res->num_rows == 0){
                        $sql = "INSERT into hashtag (word) VALUES ('$word')";
                        $conn->query($sql);
                }
				// 해시태그가 존재하면 링킹
				$strTok[$i] = "<a href='find.php?keyword=".urlencode($strTok[$i])."'>".$strTok[$i]."</a>";
		}
		$result_contents = $result_contents.$strTok[$i].' '; 
}

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

        <?php
        $conn = sql();
        $sql = "select * from question where ix = ".$_GET["ix"].";";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        ?>
        <div class="card my-4">
          <h5 class="card-header">Solved Question</h5>
          <div class="dropdown" style="padding:20px; padding-bottom:0;">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Language
            </button>
            <?php 
              $url = $_SERVER['REQUEST_URI'];
              $langpos = strpos( $url ,"&lang");
              if(isset($_GET["lang"])){
                $noLangUrl = substr($url,0,$langpos);
              }
              else{
                $noLangUrl = $url;
              }
            ?>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="<?php echo $noLangUrl;?>">none</a>
              <a class="dropdown-item" href="<?php echo $noLangUrl."&lang=ko";?>">ko</a>
              <a class="dropdown-item" href="<?php echo $noLangUrl."&lang=en";?>">en</a>
              <a class="dropdown-item" href="<?php echo $noLangUrl."&lang=zh-CN";?>">cn</a>
              <a class="dropdown-item" href="<?php echo $noLangUrl."&lang=ja";?>">jp</a>
              <a class="dropdown-item" href="<?php echo $noLangUrl."&lang=fr";?>">fr</a>
              <a class="dropdown-item" href="<?php echo $noLangUrl."&lang=de";?>">de</a>
              <a class="dropdown-item" href="<?php echo $noLangUrl."&lang=it";?>">it</a>
            </div>
          </div>
          <div class="card-body">
              <!-- Search Widget -->
              <div class="card my-4">
                <h5 class="card-header">Title</h5>
                <div class="card-body">
                  <?php echo $row['title'] ?>
                </div>
              </div>

              <!-- Side Widget -->
              <div class="card my-4">
                <h5 class="card-header">Place</h5>
                <div class="card-body">
                  <?php echo $row['place'] ?>
                </div>
              </div>

              <!-- Categories Widget -->
              <div class="card my-4">
                <h5 class="card-header">Contents</h5>
                <div class="card-body">
                  <?php 
                    $result_contents;
                    echo $result_contents; 
                    if(isset($_GET["lang"])){
                      include 'translate.php';
                      echo "<h4> translated </h4>";
                      $transelatedContents = translate($contents,$_GET["lang"]);
                      echo $transelatedContents;
                    }
                    
                  ?>
                </div>
              </div>

              <div class="card my-4">
                <h5 class="card-header">Best Comment</h5>
                <div class="card-body">
                <?php
                  $conn = sql();
                  $sql = "select ix, contents from answer where ix = ".$row["answer_ix"];
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();
                  echo $row["contents"];
                  if(isset($_GET["lang"])){
                    echo "<h6>&nbsp;translated </h6>";
                    $transelatedContents = translate($row["contents"],$_GET["lang"]);
                    echo "&nbsp;".$transelatedContents."<br>";
                    
                  }
                    
                  ?>          
                      
                </div>
              </div>
              <div class="card my-4">
                <h5 class="card-header">All Comments</h5>
                <div class="card-body">
                <li style="list-style:none;">
                <?php
                $conn = sql();
                $sql = "select ix, contents from answer where question_ix = ".$_GET["ix"];
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  $count = 1;
                  while($row = $result->fetch_assoc()) {
                    echo $count.": ".$row["contents"]." <br>";
                    if(isset($_GET["lang"])){
                      echo "<h6>&nbsp;translated </h6>";
                      $transelatedContents = translate($row["contents"],$_GET["lang"]);
                      echo "&nbsp;".$transelatedContents."<br>";
                      
                    }
                  $count += 1;
                  }
                }
                ?>
                </li>        
                      
                </div>
              </div>


              <a href='solved_question_list.php' class="btn btn-custom service-gap">
              Back
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