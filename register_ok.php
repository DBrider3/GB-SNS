<!DOCTYPE html>
<meta charset="utf-8" />
<?php
if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])|| !isset($_POST['user_pw_chk'])) exit;
$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];
$user_pw_chk = $_POST['user_pw_chk'];

if($user_pw != $user_pw_chk) {
        echo "<script>alert('Password is not Correct!');history.back();</script>";
        exit;
}

// 이미 아이디가 존재하는 경우
include 'sql.php';
$conn = sql();
$sql = "SELECT * FROM user WHERE id='$user_id'";
$res = $conn->query($sql);
if($res->num_rows > 0){
    echo "<script>alert('There is already an ID'); history.back();</script>";
    exit;
}

$sql = "INSERT INTO user (id, pw) VALUES ('$user_id','$user_pw')";
if ($conn->query($sql) === TRUE) {
        $conn->close();        
        print "<script language=javascript> alert('register success'); location.replace('./main.php'); </script>";
} else {
        print "<script language=javascript> alert(\"register failed $conn->error\"); location.replace('./main.php'); </script>";

}
?>