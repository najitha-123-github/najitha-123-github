
<html>
<head>  
    <link rel="stylesheet" href="manageteachers.css">
    <link rel="stylesheet" href="admin.css">
    <title>LOGIN</title>
</head>
<body>
    <nav class="nanbar">
        <div class="navbar">
            <a href="#">ONLINE LIBRARY MANAGEMENT SYSTEM</a>
            <div class="link">
                <a href="index.html">home</a>
                <a href="teacherdash.html"></a>

            </div>
        </div>
    </nav>
    <div class="div1">
        <form class="form1" action="" method="post">
            <input class="input1" type="text" name="username" placeholder="username" required>
            <input class="input1" type="number" name="phonenumber" placeholder="phone number" required>
            <input class="input1" type="email" name="email" placeholder="email" required>
            <input class="input1" type="password" name="password" placeholder="password" required>
            <input class="input1" type="password" name="confirmpwd" placeholder="confirm password" required>
            <input class="sub2" type="submit" name="sign_up" value="sign up">
        </form>
    </div>  
</body>
</html>

<?php
$conn = mysqli_connect("localhost", "root", "", "online_library_management_system");
if (!$conn) {
    die("Database connection failed:");
}

if (isset($_POST['sign_up'])) { 
    $name = $_POST['username'];
    $phno = $_POST['phonenumber'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $confirmpassword = $_POST['confirmpwd']; 

    if($pwd == $confirmpassword){
        $sql ="INSERT INTO `teacher`(`username`, `phonenumber`, `email`, `password`) VALUES ('$name','$phno','$email','$pwd')";
        $data = mysqli_query($conn, $sql);
        if ($data) {
            echo "<script>alert('Record added');</script>";
        } else {
            echo "<script>alert('Record invalid');</script>";
        }
    }
     else {
        echo "<script>alert('Passwords do not match');</script>";
    }
}
 else {
    echo "Form not submitted";
}

mysqli_close($conn); 
?>
