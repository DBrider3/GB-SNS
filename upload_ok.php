<!DOCTYPE html>
<meta charset="utf-8" />
<?php

session_start();

include 'sql.php';
include 'translate.php';
$conn = sql();

if(!isset($_SESSION['user_id'])) {
	echo "<meta http-equiv='refresh' content='0;url=login.php'>";
	exit;
}
$user_id = $_SESSION['user_id'];

if(!isset($_POST['title']) || !isset($_POST['contents'])|| !isset($_POST['place'])) exit;

$title = translate($_POST['title'],"en")."(orig.".$_POST['title'].")";
//$title = $_POST['title'];
$contents = $_POST['contents'];
$place = $_POST['place'];
/*
$strTok =explode(' ' , $contents);
$cnt = count($strTok);
for($i = 0 ; $i < $cnt ; $i++){
        if($strTok[$i][0] == '#'){
                $word = $strTok[$i];
                $sql = "SELECT * from hashtag where word = \"$word\"";
                $res = $conn->query($sql);
                if($res->num_rows == 0){
                        $sql = "INSERT into hashtag (word) VALUES ('$word')";
                        $conn->query($sql);
                }
                //해시태그가 없으면 새로 만들기
                //갯수 증가
                $sql = "UPDATE hashtag SET count = count + 1 WHERE word = \"$word\"";
                $conn->query($sql);
        }
}
*/
$sql = "INSERT INTO question (title, contents, place, user_id) VALUES ('$title','$contents','$place', '$user_id')";
// user_id 넣을까 말까
if ($conn->query($sql) === TRUE) {
        $conn->close();
        print("success");
        print "<script language=javascript> alert('question success'); location.replace('./main.php'); </script>";
} else {
        $conn->close();
        echo "failed";
        print "<script language=javascript> alert(\"question failed $conn->error\"); location.replace('./main.php'); </script>";

}

?>
