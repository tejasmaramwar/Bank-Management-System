<?php
$showalert=false;
$showerror=false;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        include 'partials/_dbConnect.php';

        
        $username = $_POST["username"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $dob = $_POST["dob"];
        $acno = $_POST["acno"];
        $gender = $_POST["gender"];
        $city = $_POST["city"];
        $balance = $_POST["balance"];

        // $exists = false;
        //CHECKING WHETHER THIS USERNAME EXISTS
        $existsql = "SELECT * FROM `users` WHERE username = '$username'";
        $result = mysqli_query($conn, $existsql);
        $numexistsrows = mysqli_num_rows($result);

        if($numexistsrows > 0)
        {
            // $exists = true;
            $showerror = "Username already exists or account number already exits";
        }
        else
        {
            $exists = false;
            if(($password == $cpassword))
            {
                $sql = "INSERT INTO `users` (`fname`, `lname`, `dob`, `acno`, `gender`, `city`, `username`, `password`, `balance`, `dt`) VALUES ('$fname', '$lname', '$dob', '$acno', '$gender', '$city', '$username', '$password', '$balance', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if($result)
                {
                    $showalert = true;
                }
            }
            else
            {
                $showerror = "Password do not match";
            }
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

    <title>Bank Management System</title>
  </head>
  <body>

    <?php require 'partials/_nav.php' ?>

    <?php
        if($showalert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You have successfully signed up to swiss bank.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    ?>

    <?php
        if($showerror){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong>' . $showerror.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    ?>

    <div class="container my-4">
        <h1 class="text-center">Create your account</h1>
        <form action="/bms/signup.php" method="post">
        <div class="mb-2 col-md-6">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="fname" name="fname" autocomplete="off">
        </div>
        <div class="mb-2 col-md-6">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lname" name="lname" autocomplete="off">
        </div>
        <div class="mb-2 col-md-6">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="text" class="form-control" id="dob" name="dob" placeholder="DDMMYYYY" autocomplete="off">
        </div>
        <div class="mb-2 col-md-6">
            <label for="acno" class="form-label">Acount Number</label>
            <input type="text" class="form-control" id="acno" name="acno" autocomplete="off">
        </div>
        <div class="mb-2 col-md-6">
            <label for="gender" class="form-label">Gender</label>
            <!-- <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Gender
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">Male</a></li>
                <li><a class="dropdown-item" href="#">Female</a></li>
                <li><a class="dropdown-item" href="#">NA</a></li>
            </ul>
            </div> -->
            <input type="text" class="form-control" id="gender" name="gender" autocomplete="off">
        </div>
        <div class="mb-2 col-md-6">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" autocomplete="off">
        </div>
        <div class="mb-2 col-md-6">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" maxLength = "11" id="username" name="username" aria-describedby="emailHelp" autocomplete="off">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-2 col-md-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-2 col-md-6">
            <label for="cpassword" class="form-label">Confirm your Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword">
            <div id="emailHelp" class="form-text">Make sure to type the same password.</div>
        </div>
        <div class="mb-2 col-md-6">
            <label for="balance" class="form-label">Opening Balance</label>
            <input type="text" class="form-control" id="balance" name="balance" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary">Create Account</button>
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