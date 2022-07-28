<!DOCTYPE html>
<head>
  <title>Record Search</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
   <br/>
  <?php
      session_start();
      require "db.php";
      if (isset($_POST['username']))
      {
          $username = $_POST['username'];
          $password = sha1($_POST['password']);
          $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

          $result = $conn->query($sql);

          if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            $_SESSION['usergroup'] = $row['usergroup'];
          } else {
            ?>
            <div class="alert alert-danger" role="alert"><p>Invalid Login</p></div>
              <?php
          }
      }

      if (isset($_SESSION['username'])){
        ?>
        <div class="alert alert-secondary clearfix" role="alert">
          <p>Hello, <?php echo $_SESSION['username'] ?>!</p> <a  class="btn btn-secondary float-right" href="logout.php">Logout</a>
        </div>
        <h1>Record Search</h1>
        <form method="post">
            <label for="record" class="form-label">Record Name</label>
          <div class="input-group has-validation">
            <input type="text" id="record" name="record" class="form-control" required>
          </div><br/>
          <input type="submit" value="OK" class="btn btn-primary"/> <a href="create.php" class="btn btn-secondary">Create Record</a>
        </form>
        <br/>
        <?php
              $_SESSION['lastrec'] = "";
              if (isset($_POST['record']))
              {
                $record = $_POST['record'];
                $sql2 = "SELECT * FROM records WHERE recordname='$record'";

                $result2 = $conn->query($sql2);

                if ($result2->num_rows > 0)
                {
                  $row = $result2->fetch_assoc();
                  if ($row['usergroup'] == $_SESSION['usergroup'] || $_SESSION['usergroup'] == 'wheel')
                  {
                  ?>
                       <div class="card">
                          <div class="card-body">
                                 <h3 class="card-title"><?php echo $row['recordname'] ?></h3>
                                 <p class="card-text"><?php echo $row['content'] ?></p>
                                 <a href="delete.php" class="btn btn-danger">Delete</a>
                          </div>
                        </div>
                  <?php
                    $_SESSION['lastrec'] = $row['recordname'];
                  } else {
                    ?>
                    <div class="alert alert-danger" role="alert">
                     Record Access Denied.
                    </div>
                    <?php
                  }
                } 
                else
                {
                  ?>
                    <div class="alert alert-danger" role="alert">
                     No Record Found
                    </div>
                  <?php
                }
              }
         ?>
         <a href="passwd.php" class="btn btn-warning">Change Password</a>
<?php
        } else {
  ?>
        <h1>Login</h1>
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
          <br/>
          <input type="submit" value="OK" class="btn btn-primary"/> <a href="signup.php" class="btn btn-secondary">Create Account</a>
      </form>
      <?php
      }
      ?>

      </div>

 </body>
