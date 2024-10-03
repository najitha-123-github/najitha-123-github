<!DOCTYPE html>
<html>
<head>
    <title>Library Management System</title>
    <link rel="stylesheet" href="reg.css">
</head>
<body>
<nav class="nanbar">

        <div class="navbar">
            <a href="#">ONLINE LIBRARY MANAGEMENT SYSTEM</a>
            <div class="link">
                <a href="./index.html">home</a> 
                <a href="./login.php">login</a>
                <a href="./fee.php">feedback</a>
            </div>
        </div>
        </div>

    </nav>

    <div class="logincontainer">
        <h1 class="LoginHead"><b>MES COLLEGE MARAMPALLY</b></h1>
        <form class="loginform" action="" method="post">
            <h3 class="abcd"><b>REIGISTER ONLINE LIBRARY MANAGEMENT SYSTEM</b></h3>
            <input class="doc1" type="text" name="name" placeholder="Name" required><br>
            <input class="doc1" type="text" name="phonenumber" placeholder="Phone Number" required><br>
            <input class="doc1" type="email" name="email" placeholder="E-mail" required><br>
            <input class="doc1" type="text" name="username" placeholder="Username" required><br>
            <input class="doc1" type="password" name="password" placeholder="Password" required><br>
            <input class="doc1" type="password" name="confirmpassword" placeholder="Confirm Password" required><br>
            <input class="LoginButton" type="submit" name="submit" value="SIGN UP">
        </form>
    </div>
</body>
</html>

<?php
$conn = mysqli_connect("localhost", "root", "", "online_library_management_system");
if (!$conn) {
    die("Database connection failed:");
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $type=0;

    if ($password === $confirmpassword) {
        $sql = "INSERT INTO `users` (`name`, `phonenumber`, `email`, `username`, `password`) VALUES ('$name', '$phonenumber', '$email', '$username', '$password')";
      $sql1="INSERT INTO `login`(`email`, `password`, `user_type`) VALUES ('$email','$password','$type')";
        $data = mysqli_query($conn, $sql);
        $data1= mysqli_query($conn, $sql1);
        if ($data && $data1) {
            echo "<script>alert('Record added');</script>";
        } else {
            echo "<script>alert('Error');</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match');</script>";
    }
} else {
    // echo "<script>alert('Form not submitted');</script>";
}

mysqli_close($conn);
?>
 <!-- #region -->