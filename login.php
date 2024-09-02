
<html>
  <head>
    <link rel="stylesheet" href="login.css">
    <title>login page</title>

  </head>
<body>
< <nav class="nanbar">

<div class="navbar">
    <a href="#">ONLINE LIBRARY MANAGEMENT SYSTEM</a>
    <div class="link">
        <a href="./index.html">home</a> 
        <a href="./reg.php">register</a>
        <a href="./fee.php">feedback</a>
    </div>
</div>
</div>

</nav>
  <div class="logincontainer">
    <form class="loginform" action="" method="post">
    <h2 class="LoginHead">MES COLLEGE MARAMPALLY</h2>
    <p class="abcd">Login To Access Online Library Management</p>
      <input class="doc1" type="name" name="email" placeholder="email">
      <input class="doc1" type="Password" name="Password" placeholder="password">
      <input class="LoginButton" type="submit" name="submit" value="LOGIN">
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
$sql="SELECT * FROM `login` WHERE `email`='$email' AND `password`='$pasword'";
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
