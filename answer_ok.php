<!DOCTYPE html>
<meta charset="utf-8" />
<?php

session_start();

include 'sql.php';
$conn = sql();

if(!isset($_SESSION['user_id'])) {
	echo "<meta http-equiv='refresh' content='0;url=login.php'>";
	exit;
}
$user_id = $_SESSION['user_id'];

if(!isset($_POST['question_ix']) || !isset($_POST['contents'])) exit;
$question_ix = $_POST['question_ix'];
$contents = $_POST['contents'];

$sql = "INSERT INTO answer (question_ix , contents) VALUES ('$question_ix','$contents')";
// user_id 넣을까 말까
if ($conn->query($sql) === TRUE) {
        $conn->close();
        print("success");
        print "<script language=javascript> alert('question success'); location.replace('./question_detail.php?ix=$question_ix'); </script>";
} else {
        $conn->close();
        echo "failed";
        print "<script language=javascript> alert(\"question failed $conn->error\"); location.replace('./question_detail.php?ix=$question_ix'); </script>";

}

?>
