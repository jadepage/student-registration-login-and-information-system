<?php
session_start();
$_SESSION['message'] = '';

$mysqli = new mysqli('localhost', 'root','', 'rgi_student');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  // Check if 2 passwords match
  if ($_POST['password'] == $_POST['confirmpassword']) {

    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $firstname = $mysqli->real_escape_string($_POST['firstname']);
    $surname = $mysqli->real_escape_string($_POST['surname']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $qualification =  $_POST['qualification'];
    $cellnumber = $mysqli->real_escape_string($_POST['cellnumber']);
    $gender = $mysqli->real_escape_string($_POST['gender']);
    $nationality = $_POST['nationality'];

    $_SESSION['username'] = $username;

    $sql = "INSERT INTO student_reg (username, password, firstname, surname, email, qualification, cellnumber, gender, nationality) "
      ."VALUES ('$username', '$password', '$firstname', '$surname', '$email', '$qualification', '$cellnumber', '$gender', '$nationality')";

      // if successful then redirect to welcome.php page
      if($mysqli->query($sql) === true) {
        $_SESSION['message'] = "Registration Successful";
      } else {
        $_SESSION['message'] = "User could not be added to the database";
      }
  } else {
    $_SESSION['message'] = "Sorry the 2 passwords don't match";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="style.css" type="text/css">
  <title>Registration</title>
</head>
<body>
<div class="body-content">
  <div class="module">
    <h1>Student Registration</h1>
    <form class="form" action="registration.php" method="post" enctype="multipart/form-data" autocomplete="off">

      <!--  Error message gets displayed here -->
      <div class="alert alert-error"><?= $_SESSION['message']?></div>
      <label for='username'>Username</label>
      <input type="text" placeholder="myusername" name="username" required />
      <label for='firstname'>First Name</label>
      <input type="text" placeholder="Joe" name="firstname" required />
      <label for='surname'>Surname</label>
      <input type="text" placeholder="Doe" name="surname" required />
      <label for='surname'>Email</label>
      <input type="email" placeholder="example@domain.com" name="email" required />
      <label for='qualification'>Qualification</label>
      <select name="qualification" size='1'>
        <option value='BSC IT'>BSC IT</option>
        <option value='Diploma IT'>Diploma IT</option>
        <option value='N5 IT'>N5 IT</option>
      </select>
      <label for='cellnumber'>Cell Number</label>
      <input type="text" placeholder="1234100" name="cellnumber" required />
      <label for="gender">Gender</label> 
        <div style="margin:10px;">
          <label  for="genderMale">Male</label>  
          <input type="radio" name="gender" id="male" value="Male"  required /> 
          <label for="genderFemale">Female</label>  
          <input type="radio" name="gender" id="female" value="Female" /> 
        </div>
      <label for='nationality'>Nationality</label>
      <select name="nationality" size='1'>
        <option value='South African'>South African</option>
        <option value='Namibian'>Namibian</option>
        <option value='British'>British</option>
      </select>
      <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
      <input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required />
      <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>
  
</body>
</html>



