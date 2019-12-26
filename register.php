<!DOCTYPE html>
<html lang="ko">
<head>
    <title>GB SNS</title>
    <meta charset="utf-8">
    <meta http-equiv = "X-UA-Compatible"content = "IE = edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">


</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">GB SNS</h5>
            <hr class="my-4">
            <h5 class="card-title text-center">Sign Up</h5>
            <form class="form-signin" method='post' action='register_ok.php'>
              <div class="form-label-group">
                <input type="id" id="user_id" name='user_id' class="form-control" placeholder="ID" required autofocus>
                <label for="user_id">ID</label>
              </div>
              <div class="form-label-group">
                <input type="password" id="user_pw" name='user_pw' class="form-control" placeholder="Password" required>
                <label for="user_pw">Password</label>
              </div>
              <div class="form-label-group">
                  <input type="password" id="user_pw_chk" name='user_pw_chk' class="form-control"
                  placeholder="Password" required>
                  <label for="user_pw_chk">Password Check</label>
              </div>
              
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign Up</button>
              
              
              <hr class="my-4">
              <button class="btn btn-lg btn-signup btn-block text-uppercase" onclick="location.href='login.php'">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script type="text/javascript" src="js/bootstrap.js"></script>
 <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
 <script type="text/javascript" src="js/jquery.slim.min.js"></script>
</body>
</html>