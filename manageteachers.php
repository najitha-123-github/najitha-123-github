

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
                <a href="admin.html">home</a>
                <a href="teacherdash.html"></a>

            </div>
        </div>
    </nav>
    <div class="div1">
    <h1>Add Teachers</h1>
        <form class="form1" action="" method="post">
            <input class="input1" type="text" name="username" placeholder="username" required>
            <input class="input1" type="number" name="phonenumber" placeholder="phone number" required>
            <input class="input1" type="email" name="email" placeholder="email" required>
            <input class="input1" type="password" name="password" placeholder="password" required>
            <input class="input1" type="password" name="confirmpwd" placeholder="confirm password" required>
            <input class="sub2" type="submit" name="sign_up" value="sign up">
        </form>

<?php
$conn = mysqli_connect("localhost", "root", "", "online_library_management_system");
if (!$conn) {
    echo "Database connection failed:";
    exit();

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


mysqli_close($conn); 
?>
        <div class="ViewCandidatesBodyContainer">
            <?php
    $conn = mysqli_connect("localhost", "root", "", "online_library_management_system");
    if(!$conn){
        echo "Database not connected";
    }
    $sql = "SELECT * FROM `teacher`";
    $data=mysqli_query($conn,$sql);
    if(mysqli_num_rows($data)>0){  
        echo "<table border=1 >";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Phone Number</th>";
        echo "<th>User ID</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($data)){
            $email = $row['email'];
            $id= $row['user_id'];
            echo "<tr>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['phonenumber']."</td>";
            echo "<td>".$row['user_id']."</td>";
            echo "<td>
            <form method='POST' style='display:inline;'>
                <button value='$email' name='userdel' type='submit'>Delete</button>
            </form>
    <td><form method='post' action='staffedit.php'><button value='{$id}' name='staffedit' class='deluser' type='submit'>EDIT</button></form></td>";

             echo "</tr>";
        }
        echo "</table>";
    }
?>
        </div>
        </div>
    </body>
</html>
<?php
$conn = mysqli_connect("localhost", "root", "", "online_library_management_system");
if(!$conn){
    echo "Database not connected";
}
if(isset($_POST['userdel'])){
    $email = $_POST['userdel'];
    if(!empty($_POST['userdel'])){
        $sql = "DELETE FROM `teacher` WHERE `email`='$email'";
        $data = mysqli_query($conn, $sql);
        $sql1 = "DELETE FROM `login` WHERE `email`='$email'";
        $data1 = mysqli_query($conn, $sql1);
        echo "<script>window.location.replace('./manageteachers.php');</script>";
    }
}
?>

