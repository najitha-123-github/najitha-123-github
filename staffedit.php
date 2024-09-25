
<html>
<head>  
    <link rel="stylesheet" href="manageteachers.css">
    <link rel="stylesheet" href="staffedit.css">
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
    <div class="div2">
        <h1 class="naj">MANAGE STAFF</h1cl>
        <?php
        // Check if 'staffedit' is set in the POST request
        if (isset($_POST['staffedit'])) {
            $id = $_POST['staffedit'];
            $conn = mysqli_connect("localhost", "root", "", "online_library_management_system");
             
                $sql = $conn->query("SELECT * FROM teacher WHERE user_id='$id'");
                $userDetails = $sql->fetch_assoc();
                
                if (isset($_POST['register'])) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $phno = $_POST['phno'];
                    $passwd = $_POST['password'];
                    $profileUpdateSql = $conn->query("UPDATE `teacher` SET `username`='$username',`email`='$email',`phonenumber`='$phno',`password`='$passwd' WHERE `user_id`='$id'");
                    
                    if ($profileUpdateSql) {
                        echo "<script>alert('Update successful')</script>";
                        header("Location: manageteachers.php");
                        exit();
                    } else {
                        echo "<script>alert('Update Failed')</script>";
                    }
                }
            } else {
                echo "Database connection failed.";
            }   
        ?>
        <form method="post">
            <div class="div3">
            <input type="hidden" name="staffedit" value="<?php echo htmlspecialchars($id); ?>">
            <table>
                <tr>
                    <td>Staff Name:</td>
                    <td><input required class="inp" type="text" name="username" value="<?php echo htmlspecialchars($userDetails['username']); ?>" placeholder="Fullname"><br></td>
                </tr>
                <tr>
                    <td>Email-ID:</td>
                    <td><input required class="inp" type="email" name="email" value="<?php echo htmlspecialchars($userDetails['email']); ?>"><br></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input required class="inp" type="text" name="phno" value="<?php echo htmlspecialchars($userDetails['phonenumber']); ?>"><br></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input required class="inp" type="password" name="password" value="<?php echo htmlspecialchars($userDetails['password']); ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button id="hero_bt" type="submit" name="register">Update</button></td>
                </tr>
            </table>
        </div>
            
        </form>
    
</body>
</html>
