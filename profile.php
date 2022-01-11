<?php
    session_start();
    $acno = $_SESSION['acno'];

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
    {
        header("location: login.php");
        exit;
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
    
    <div class="container">
      <h1 class="text-center my-4">Your Profile</h1>
        <!-- <div class="card">
            <img src="img.jpg" alt="John" style="width:100%">
            <h1>Tejas Maramwar</h1>
            <p class="title">Customer, Swiss Bank</p>
            <p class="title">Customer, Swiss Bank</p>
            <p class="title">Customer, Swiss Bank</p>
            <p class="title">Customer, Swiss Bank</p>
        </div> -->

        <table class="table  table-hover">
            <thead>
                <tr>
                    <th scope="col">Fields</th>
                    <th scope="col">Values</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">First Name</th>
                    <td>Mark</td>
                </tr>
                <tr>
                    <th scope="row">Last Name</th>
                    <td>Jacob</td>
                </tr>
                <tr>
                    <th scope="row">DOB</th>
                    <td colspan="2">01052000</td>
                </tr>
                <tr>
                    <th scope="row">Account No</th>
                    <td colspan="2">1001</td>
                </tr>
                <tr>
                    <th scope="row">Gender</th>
                    <td colspan="2">male</td>
                </tr>
                <tr>
                    <th scope="row">city</th>
                    <td colspan="2">pune</td>
                </tr>
            </tbody>
        </table>
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