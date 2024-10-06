<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "online_library_management_system");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id']; 
$book_id = intval($_POST['book_id']);
$duration = mysqli_real_escape_string($conn, $_POST['duration']);


$sql = "INSERT INTO bookings (user_id, book_id, duration) VALUES ('$user_id', '$book_id', '$duration')";
if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Booking successful!');
            window.location.href = 'studentdashboard.php';
          </script>";
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
