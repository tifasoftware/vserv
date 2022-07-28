<?php
  session_start();

  require "db.php";

  if (isset($_POST['password']))
  {
    $password = sha1($_POST['password']);
    $password2 = sha1($_POST['password2']);
    $oldpassword = sha1($_POST['oldpassword']);
    $username= $_SESSION['username'];
    $sql2 = "SELECT * FROM users WHERE username='$username' AND password='$oldpassword'";
    $result2 = $conn->query($sql2);
    
    if ($result2->num_rows > 0 && $password == $password2)
    {
      $sql = "UPDATE users SET password='$password' WHERE username='$username'";

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
        echo "Password Check Failed! <br>";
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
  <h2>Change Password</h2>
        <form method="post">
            <label for="oldpassword" class="form-label">Old Password</label>
            <div class="input-group has-validation">
              <input type="password" id="oldpassword" name="oldpassword" class="form-control" required><br/>
            </div>
            <label for="password" class="form-label">New Password</label>
            <div class="input-group has-validation">
              <input type="password" id="password" name="password" class="form-control" required><br/>
            </div>
            <label for="password2" class="form-label">Confirm Password</label>
            <div class="input-group has-validation">
              <input type="password" id="password2" name="password2" class="form-control" required><br/>
            </div>
            <input type="submit" value="OK" class="btn btn-primary"/> <a href="index.php" class="btn btn-secondary">Cancel</a>  <a href="delete_acct.php" class="btn btn-danger">Delete Account</a> 
        </form>
        <br/>
</div>
</body>
<?php } ?>