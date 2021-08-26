<?php
   session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="homepage.css">
    <title>Home Page</title>
</head>
<body>
  <div class="container">
    <div class="content">
      <h1>Welcome</h1>
      <h2 class='headers'><?php echo $_SESSION['username']?></h2>
    </div>
  </div>
  <form action="" method="post">
    <div class='buttons'>
      <input type="submit" value="FEES" name='fees' class="btn btn-block btn-primary fees-btn">

      <input type="submit" value="ATTENDANCE" name='attendance' class="btn btn-block btn-primary attendance-btn">
      <input type="submit" value="RESULTS" name='results' class="btn btn-block btn-primary results-btn">
      
      <!-- Logs the user out and sends them back to the home login screen -->
      <button class="btn btn-block btn-primary"><a style="color: white;text-decoration: none;" href='logout.php'>LOGOUT</a></button>
    </div>
  </form>


    <?php

      // Connect to database
      $connection = mysqli_connect('localhost', 'root','', 'rgi_student');

      // Select from student_info table
      $sql_studentInfo = "SELECT * FROM student_info;";

      // Student info results
      $studentInfo_result = mysqli_query($connection, $sql_studentInfo);


      // Select from student_info table
      $sql_studentReg = "SELECT * FROM student_reg;";

      // Student info results
      $studentReg_result = mysqli_query($connection, $sql_studentReg);

      // Select from student_res table
      $sql_studentRes = "SELECT * FROM student_res;";

      // Student res results
      $studentRes_result = mysqli_query($connection, $sql_studentRes);

      // Show fees table
      if(isset(($_POST["fees"]))) {
        echo "<div class='container'><h2 class='headers'>STUDENT FEES</h2></div>";
        echo "<table style='x;' class='container'>";
        echo '<tr>';
        echo '<th>StudentID</th>';
        echo '<th>Student Name</th>';
        echo '<th>Balance</th>';
        echo '<th>Due Date</th>';
        echo '</tr>';
        echo '<tr>';
        
        
        // Display student id & name from student_reg db table
        while($row = mysqli_fetch_assoc($studentReg_result)) {
          echo "<td>{$row['stid']}</td>";
          echo "<td>{$row['firstname']}</td>";
        }
        
        // Display student balance & due date from student_info db table
        while($row = mysqli_fetch_assoc($studentInfo_result)) {
          echo "<td>R{$row['std_balance']}</td>";
          echo "<td>{$row['due_date']}</td>";
        }
        echo '</tr>';
        echo "</table>";
      
      // Show attendance table
      }  else if (isset(($_POST["attendance"]))) {
        echo "<div class='container'><h2 class='headers'>STUDENT ATTENDANCE</h2></div>";
        echo "<table class='container'>";
        echo '<tr>';
        echo '<th>StudentID</th>';
        echo '<th>Student Name</th>';
        echo '<th>Attendance</th>';
        echo '</tr>';
        echo '<tr>';

        // Display student id & student name from student_reg db table
        while($row = mysqli_fetch_assoc($studentReg_result)) {
          echo "<td>{$row['stid']}</td>";
          echo "<td>{$row['firstname']}</td>";
        }
        
        // Display student attendance from student_info db table
        while($row = mysqli_fetch_assoc($studentInfo_result)) {
          echo "<td>{$row['attendance']}%</td>";
        }

        echo '</tr>';
        echo "</table>";

      // Show results table
      } else if (isset(($_POST["results"]))) {
        echo "<div class='container'><h2 class='headers'>STUDENT RESULTS</h2></div>";
        echo "<table class='container'>";
        echo '<tr>';
        echo '<th>StudentID</th>';
        echo '<th>Student Name</th>';
        echo '<th>Module</th>';
        echo '<th>Results</th>';
        echo '</tr>';
        echo '<tr>';

        // Display student id, name & from student_reg db table
        while($row = mysqli_fetch_assoc($studentReg_result)) {
          echo "<td>{$row['stid']}</td>";
          echo "<td>{$row['firstname']}</td>";
        }

         // Display student id & name from student_reg db table
        while($row = mysqli_fetch_assoc($studentReg_result)) {
          echo "<td>{$row['stid']}</td>";
          echo "<td>{$row['firstname']}</td>";
        }

        // Display student id & name from student_reg db table
        while($row = mysqli_fetch_assoc($studentRes_result)) {
          echo "<td>{$row['module']}</td>";
          echo "<td>{$row['final_mark']}%</td>";
        }
        echo '</tr>';
        echo "</table>";
      } 
    ?>
  </body>
</html>



