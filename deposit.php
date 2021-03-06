<?php
    $balance = 0;
    $successdepositalert = false;
    $zerodepositalert = false;
    session_start();
    $acno = $_SESSION['acno'];

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
    {
        header("location: login.php");
        exit;
    }

    include 'partials/_dbConnect.php';

    $sql = "SELECT balance FROM `users` WHERE acno = '$acno'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        while($row = mysqli_fetch_assoc($result)) {
          $balance = $row["balance"];
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // include 'partials/_dbConnect.php';

        $depositamount = $_POST["depositamount"];

        $addition = $balance + $depositamount;

        $sql = "UPDATE `users` SET `balance` = '$addition' WHERE `acno` = $acno";
        $result = mysqli_query($conn, $sql);
        if($depositamount == 0)
        {
            $zerodepositalert = true;
        }
        else if($result)
        {
            $successdepositalert = true;
        }
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <title>Bank Management System</title>
  </head>
  <body>

    <?php require 'partials/_nav.php' ?>

    <?php
        if($successdepositalert)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Deposit was successful, you can now return to dashboard by pressing the back button.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>

    <?php
        if($zerodepositalert)
        {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Deposit amount cannot be zero. Please enter amount greater than zero.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>
    
    <div class="container">
      <h1 class="text-center my-4">Deposit Funds</h1>
      <form action="/bms/deposit.php" method="post">
        <div class="mb-3">
          <label for="acno" class="form-label">Account No.</label>
          <br>
          <?php
            echo $acno;
          ?>
        </div>
        <div class="mb-3">
          <label for="acno" class="form-label">Available Balance.</label>
          <br>
          <?php
            echo $balance;
          ?>
        </div>
        <div class="mb-3 col-md-4">
          <label for="depositamount" class="form-label">Amount to deposit</label>
          <input type="text" class="form-control" id="depositamount" name="depositamount" placeholder="Enter amount in rupees">
        </div>
        <button type="submit" class="btn btn-primary btn-lg ">Deposit</button>
      </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>