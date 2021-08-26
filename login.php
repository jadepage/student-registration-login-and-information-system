<?php
  $_SESSION['message'] = '';
  if(isset($_POST["login"])) {
    $connection = new mysqli('localhost', 'root','', 'rgi_student');

    $username = $connection->real_escape_string($_POST["username"]);
    $password = $connection->real_escape_string($_POST["password"]); 

    $data = $connection->query("SELECT * FROM student_reg WHERE username='$username' AND password = '$password'");


    if ($data->num_rows > 0) {
      session_start();
      $_SESSION['message'] = "Successful login";
      $_SESSION['username'] = $username;
      $_SESSION['loggedIn'] = True;

      header("Location: home.php");
      exit();

    } else {
      $_SESSION['message'] = "Unsuccessful login, please check email or password";
    }
  }

?>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="style.css" type="text/css">
  <link rel="stylesheet" href="login.css" type="text/css">
  <title>Document</title>
</head>
<body>
<div class="body-content">
  <div class="module">
    <h1>Student Login</h1>
    <form class="form" action="login.php" method="post">
       <!--  Error message gets displayed here -->
       <div class="alert alert-error"><?= $_SESSION['message']?></div>
      <label for='username'>Username</label>
      <input type="text" placeholder="myusername" name="username" required />
      <label for='password'>Password</label>
      <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
      <div class='login-container'>
        <input type="submit" value="Login" name="login" class="btn btn-block btn-primary" />
        <button class="btn btn-block btn-primary"><a href='registration.php'>Register</a></button>
      </div>
    </form>
  </div>
</div>
</body>
</html>
