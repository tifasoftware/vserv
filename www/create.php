<?php
  session_start();

  require "db.php";

  if (isset($_POST['record']))
  {
    $record = $_POST['record'];
    $content = $_POST['cont'];
    $owngroup = $_SESSION['usergroup'];
    $sql2 = "SELECT * FROM records WHERE recordname='$record'";
    $result2 = $conn->query($sql2);
    
    if ($result2->num_rows == 0)
    {
      $sql = "INSERT INTO records (recordname, content, usergroup) VALUES ('$record','$content','$owngroup')";

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
        echo "Record name exists! <br>";
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
            <label for="record" class="form-label">Record Name</label>
            <div class="input-group has-validation">
              <input type="text" id="record" name="record" class="form-control" required><br/>
            </div>
            <label for="cont" class="form-label">Content</label>
            <textarea id="cont" name="cont" class="form-control"></textarea><br/>
            <input type="submit" value="OK" class="btn btn-primary"/> <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
        <br/>
</div>
</body>
<?php } ?>