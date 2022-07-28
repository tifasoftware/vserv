<?php
  session_start();

  require "db.php";

  if (isset($_POST['username']))
  {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $cpassword = sha1($_POST['cpassword']);
    $username2 = $_POST['username2'];
    $password2 = sha1($_POST['password2']);
    $owngroup = $_POST['usergroup'];
    $sql2 = "SELECT * FROM users WHERE username='$username'";
    $sql3 = "SELECT * FROM users WHERE username='$username2' AND password='$password2' AND usergroup='wheel'";

    $result3 = $conn->query($sql3);
    $result2 = $conn->query($sql2);
   
    if ($result3->num_rows > 0 && $password == $cpassword){
      if ($result2->num_rows == 0)
      {
        $sql = "INSERT INTO users (username, password, usergroup) VALUES ('$username','$password','$owngroup')";

        if ($conn->query($sql) == TRUE)
        {
          header("Location: index.php");
        } else 
        {
          echo "Error: " . $sql . "<br>" . $conn->error;
          echo "<a href='index.php'>Return</a>";
        }
      } else 
      {
          echo "Account exists! <br>";
          echo "<a href='index.php'>Return</a>";
      }
    } else 
    {
          echo "Account creation not authorized! <br>";
          echo "<a href='index.php'>Return</a>";
    }
  } else {
?>
<!DOCTYPE html>
<head>
  <title>Record Search</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
  <h1>Record Search</h1>
  <h2>Create Record</h2>
        <form method="post">
            <label for="username" class="form-label">Username</label>
          <div class="input-group has-validation">
            <input type="text" id="username" name="username" class="form-control" required>
          </div>
          <br/>
            <label for="password" class="form-label">Password</label>
          <div class="input-group has-validation">
            <input type="password" id="password" name="password" class="form-control" required>
          </div>
          <br />  
            <label for="cpassword" class="form-label">Confirm Password</label>
          <div class="input-group has-validation">
            <input type="password" id="cpassword" name="cpassword" class="form-control" required>
          </div>
          <br />  
            <label for="usergroup" class="form-label">Group</label>
          <div class="input-group has-validation">
            <input type="text" id="usergroup" name="usergroup" class="form-control" required>
          </div>
          <br />  
          <label for="username2" class="form-label">Administrator Username</label>
          <div class="input-group has-validation">
            <input type="text" id="username2" name="username2" class="form-control" required>
          </div>
          <br/>
            <label for="password2" class="form-label">Administrator Password</label>
          <div class="input-group has-validation">
            <input type="password" id="password2" name="password2" class="form-control" required>
          </div>
          <br/>
        <input type="submit" value="OK" class="btn btn-primary"/> <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
        <br/>

</div>
</body>
<?php } ?>