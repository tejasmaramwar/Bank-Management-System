<?php
    $balance=0;
    $successalert = false;
    $insufficientbalancealert = false;
    $zeroamountalert = false;
    $noaccountalert = false;
    $sameaccountalert = false;

    session_start();
    $acno = $_SESSION['acno'];

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
    {
        header("location: login.php");
        exit;
    }

    //CHECKING AVAILABLE BALANCE
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
        
        $transferacno = $_POST["transferacno"];
        $amount = $_POST["amount"];
        $transferdesc = $_POST["transferdesc"];

        //CHECKING WHETHER THIS USERNAME EXISTS
        $existsql = "SELECT * FROM `users` WHERE acno = '$transferacno'";
        $result = mysqli_query($conn, $existsql);
        $numexistsrows = mysqli_num_rows($result);

        if($numexistsrows > 0 && $acno != $transferacno && $amount > 0 && $amount <= $balance)
        {
            $successalert = true;
            $transfersql = "INSERT INTO `transfer` (`transferacno`, `amount`, `transferdesc`, `dt`) VALUES ('$transferacno', '$amount', '$transferdesc', current_timestamp())";
            $result = mysqli_query($conn, $transfersql);

            // $subtraction = $balance - $amount;

            // $debitsql = "UPDATE `users` SET `balance` = '$subtraction' WHERE `acno` = $acno";
            // $creditsql = "UPDATE `users` SET `balance` = '+=$amount' WHERE `acno` = $transferacno";

            // $debitresult = mysqli_query($conn, $debitsql);
            // $creditresult = mysqli_query($conn, $creditsql);
        }
        else if($amount > $balance)
        {
            $insufficientbalancealert = true;
        }
        else if($amount == 0)
        {
            $zeroamountalert = true;
        }
        else if($acno != $transferacno)
        {
            $noaccountalert = true;
        }
        else if($acno == $transferacno)
        {
            $sameaccountalert = true;
        }
    }

    //TODO: ADD A MUTED TEXT FOR USER CONVENIENCE TO SHOW CURRENT AVAILABE BALANCE
    // $result = mysqli_query($conn, $sql);
    // $num = mysqli_num_rows($result);

    // if ($num == 1) {
    //     while($row = mysqli_fetch_assoc($result)) {
    //       $balance = $row["balance"];
    //     }
    // }
    // echo $acno;
    // echo "<br>";
    // echo $balance;
    // echo $transferacno;

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

    <!-- SHOWING SUCCESSFULL TRANSACTION ALERT-->
    <?php
        if($successalert)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Transfer was successful, you can now return to dashboard by pressing the back button.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>

    <!-- SHOWING INSUFFICIENT BALANCE ALERT-->
    <?php
        if($insufficientbalancealert)
        {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Insufficient balance to transfer.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>

    <!-- SHOWING AMOUNT TO TRANSFER CANNOT BE ZERO  ALERT-->
    <?php
        if($zeroamountalert)
        {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Amount cannot be zero.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>

    <!-- SHOWING ACCOUNT TO TRANSFER DOES NOT EXIXTS ALERT-->
    <?php
        if($noaccountalert)
        {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Account No not found.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>

    <!-- SHOWING SAME ACCOUNT TRANSFER NOT AVAILABLE-->
    <?php
        if($sameaccountalert)
        {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Account cannot be same.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    ?>
    
    <div class="container">
      <h1 class="text-center my-4">Transfer Funds</h1>
      <form action="/bms/transfer.php" method="post">
        <div class="mb-3">
          <label for="transferacno" class="form-label">Enter Account No.</label>
          <input type="text" class="form-control" id="transferacno" name="transferacno" placeholder="Account No.">
        </div>
        <div class="mb-3">
          <label for="amount" class="form-label">Enter Amount</label>
          <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount in Rupees">
        </div>
        <div class="mb-3">
        <label for="transferdesc" class="form-label">Enter Message</label>
          <textarea name="transferdesc" id="transferdesc" class="form-label contactustextarea" cols="30" rows="10" placeholder="Enter your message..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Money</button>
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