<?php
if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;
$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];

//로그인 계정 확인하는 부분
include 'sql.php';
$conn = sql();
$sql = "SELECT * FROM user WHERE id='$user_id'";
$result = $conn->query($sql);
if ($result) {
        $conn->close();
        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if($row['pw'] == $user_pw) {
                session_start();
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = "guest";
                if(isset($_SESSION['user_id'])) {
                    echo "<script>location.replace('./main.php'); </script>";
                    exit;
                } else {
                    echo "session fail";
                }
            } else {
            echo "<script>alert('ID or Password is invalid.');history.back();</script>"; exit;
            }
        } else {
            echo "<script>alert('ID or Password is invalid.');history.back();</script>"; exit;
        }
} else {
        echo "failed";
        //print "<script language=javascript> alert(\"login failed $conn->error\"); location.replace('./main.php'); </script>";
        print "<script language=javascript> alert(\"$user_id\"); location.replace('./main.php'); </script>";
}
?>
<meta http-equiv='refresh' content='0;url=main.php'>