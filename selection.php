<!DOCTYPE html>
<meta charset="utf-8" />
<?php
session_start();
include 'sql.php';
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];


$conn = sql();
$sql = "select * from answer where ix = ".$_GET["ix"].";";
$row = $conn->query($sql)->fetch_assoc();
$question_ix=$row["question_ix"];


$sql = "select * from question where ix = ".$question_ix.";";
$row = $conn->query($sql)->fetch_assoc();
$contents = $row["contents"];
$question_user = $row["user_id"];
if($question_user != $user_id) {
        
        print "<script language=javascript> alert(\"selection failed\"); location.replace('./main.php'); </script>";
        exit();
}




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

$sql = "UPDATE question SET answer_ix = ".$_GET["ix"]." WHERE ix = ".$question_ix;

if ($conn->query($sql) === TRUE) {
        $conn->close();
        print("success");
        print "<script language=javascript> alert('selection success'); location.replace('./main.php'); </script>";
} else {
        echo "failed";
        print "<script language=javascript> alert(\"selection failed $conn->error\"); location.replace('./main.php'); </script>";

}

?>
