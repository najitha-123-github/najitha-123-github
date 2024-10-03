<html>
  <head>
    <link rel="stylesheet" href="login.css">
    <title>login page</title>

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
  <form class="loginform" action="" method="post">
  <div class="login-logo">
  <img src="./assets/meslogo.png" alt="logo" width="55px" align="left">
  <div class="login-logo-text">
  <h2 align="left" font-size="2px">MES&nbsp;COLLEGE&nbsp;MARAMPALLY</h2>
  <h6>Affiliated to mahatma gandhi university, kottayam<br>NAAC reaccredited with A+</h6>
  </div>
  </div>
  <p class="abcd">Login To Access Online Library Management</p>
    <input class="doc1" type="name" name="email" placeholder="email">
    <input class="doc1" type="Password" name="Password" placeholder="password">
    <input class="LoginButton" type="submit" name="submit" value="LOGIN">
    <div class="signup-link">
        <p>Don't have an account? <a href="./reg.php">Register</a></p>
      </div>
</form>
</div>
</body>
</html>

<?php
$conn = mysqli_connect("localhost", "root", "", "online_library_management_system");
if (!$conn) {
  die("Database connection failed:");
  exit();
}
if (isset($_POST['submit'])) {
$email=$_POST['email'];
$pasword=$_POST['Password'];
$sql="SELECT * FROM login WHERE email='$email' AND password='$pasword'";
echo "$sql";
$data=mysqli_query($conn, $sql);
if($data){
    if(mysqli_num_rows($data)>0){
      $value=mysqli_fetch_assoc($data);
      if($value['user_type'] == 0) {
      header('Location: studentdashboard.html');
      echo $value['user_type'];
      exit();
    }
    else if($value['user_type'] == 1){
      header('Location: teacherdash.html');
      echo $value['user_type'];
      exit();
    }
    else{
      header('Location: admin.html');
      echo $value['user_type'];

      exit();
    }
  }
  }
    else
    {
      echo "<script>alert('invalid user');</script>";
      }
    }
  mysqli_close($conn);
  ?>