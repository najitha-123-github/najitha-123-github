<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="login.css">
    <title>Login Page</title>
</head>
<body>

<nav class="navbar">
    <div class="navbar-title">ONLINE LIBRARY MANAGEMENT SYSTEM</div>
    <ul class="nav-menu">
        <li class="abcd"><a href="./index.html"><b>Home</b></a></li>
        <li class="abcd"><a href="./fee.php"><b>Feedback</b></a></li>
    </ul>
</nav>

<div class="logincontainer">
    <form class="LoginForm" action="" method="post">
        <div class="login-logo">
            <img src="./assets/meslogo.png" alt="logo" width="57px" align="left">
            <div class="login-logo-text">
                <h2 align="left">MES&nbsp;COLLEGE&nbsp;MARAMPALLY</h2>
                <p class="abc"><b>Affiliated to Mahatma Gandhi University, Kottayam<br>NAAC reaccredited with A+ Grade</b></p>
            </div>
        </div>
        <p class="abcd"><b>Login To Access Online Library Management</b></p>
        <input class="doc1" type="text" name="email" placeholder="Email" required>
        <input class="doc1" type="password" name="password" placeholder="Password" required>
        <input class="LoginButton" type="submit" name="submit" value="LOGIN">
        <div class="signup-link">
            <p>Don't have an account? <a href="./reg.php">Register</a></p>
        </div>
    </form>
</div>

<?php
session_start(); // Start the session

$conn = mysqli_connect("localhost", "root", "", "online_library_management_system");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check login credentials
    $userSql = "SELECT * FROM login WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $userSql);

    if ($result && mysqli_num_rows($result) > 0) {
        $userDetails = mysqli_fetch_assoc($result);
        
        $userType = $userDetails['user_type'];

        if ($userType == 0) { // User
            $userInfoSql = "SELECT * FROM users WHERE email='$email'";
            $userInfoResult = mysqli_query($conn, $userInfoSql);
            if ($userInfoResult && mysqli_num_rows($userInfoResult) > 0) {
                $userInfo = mysqli_fetch_assoc($userInfoResult);
                $_SESSION['user_id'] = $userInfo['usid']; 
            }
            header('Location: studentdashboard.php');
        } elseif ($userType == 1) { // Teacher
            $teacherInfoSql = "SELECT * FROM teacher WHERE email='$email'";
            $teacherInfoResult = mysqli_query($conn, $teacherInfoSql);
            if ($teacherInfoResult && mysqli_num_rows($teacherInfoResult) > 0) {
                $teacherInfo = mysqli_fetch_assoc($teacherInfoResult);
                $_SESSION['user_id'] = $teacherInfo['user_id']; 
            }
            header('Location: teacherdash.html');
        } else {
            header('Location: admin.html'); 
        }
        exit();
    } else {
        echo "<script>alert('Invalid credentials. Please try again.');</script>";
    }
}

mysqli_close($conn);
?>
</body>
</html>
