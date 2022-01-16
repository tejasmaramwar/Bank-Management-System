<?php
    $balance = 0;
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

    <title>Swiss Bank</title>
  </head>
  <body>

    <?php require 'partials/_nav.php' ?>

    <div class="dashboardcontainer">
      <h1 class="text-center my-4">Welcome <?php echo $_SESSION['username'] ?></h1>
    </div>

    <div class="container">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Welcome <?php echo $_SESSION['username'] ?>!</h4>
            <p>Hello <?php echo $_SESSION['username']?>, How are you doing?</p>
            <p>Welcome to Swiss Bank. You are logged in as <?php echo $_SESSION['username']?></p>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to log out.</p>
        </div>


        <div class="card text-white bg-success mb-3 my-4" style="max-width: 18rem; display: inline-block; margin: 2rem;">
            <div class="card-header">Current Balance</div>
                <div class="card-body">
                    <h5 class="card-title">Your Balance is</h5>
                    <h6 class="card-text">INR - <?php echo $balance ?></h6>
                </div>
        </div>

        <div class="card" style="width: 16rem; display: inline-block; margin: 2rem;">
            <div class="card-body">
                <h5 class="card-title">Tranfer Funds</h5>
                <p class="card-text">Fastest Payment worldwide</p>
                <a href="transfer.php" class="btn btn-primary">Transer -></a>
            </div>
        </div>

        <div class="card" style="width: 16rem; display: inline-block; margin: 2rem;">
            <div class="card-body">
                <h5 class="card-title">Your Profile</h5>
                <p class="card-text">Go to your profile</p>
                <a href="profile.php" class="btn btn-primary">Profile</a>
            </div>
        </div>

        <div class="card" style="width: 16rem; display: inline-block; margin: 2rem;">
            <div class="card-body">
                <h5 class="card-title">Deposit Funds</h5>
                <p class="card-text">Fastest Payment worldwide</p>
                <a href="deposit.php" class="btn btn-primary">Deposit -></a>
            </div>
        </div>

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