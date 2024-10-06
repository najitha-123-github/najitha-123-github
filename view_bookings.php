<?php
session_start(); // Start the session

// Database connection
$conn = mysqli_connect("localhost", "root", "", "online_library_management_system");
if (!$conn) {
    die("Database connection failed:");
}

// Assuming user ID is stored in session
$userId = $_SESSION['user_id'];

// Fetch bookings for the logged-in user, joining with the books table to get book titles
$sql = "
    SELECT b.title AS book_title, bk.id AS booking_id, bk.booking_date, bk.duration
    FROM bookings bk
    JOIN books b ON bk.book_id = b.book_id
    WHERE bk.user_id = '$userId'
";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view_booking.css"> <!-- Link to your CSS -->
    <title>View Bookings</title>
</head>
<body>

<nav class="navbar">
    <div class="navbar-container">
        <a href="index.html" class="navbar-title">Library Management System</a>
        <div class="link">
            <a href="studentdashboard.php">Home</a>
            <a href="view_bookings.php">Booking</a>
            <a href="returning.php">Returning</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="doc">
    <h1>Your Bookings</h1>
</div>

<div class="bookings-table">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>Booking ID</th>
                <th>Book Title</th>
                <th>Booking Date</th>
                <th>Duration</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['booking_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['book_title']); ?></td>
                    <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['duration']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No bookings found.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php
mysqli_close($conn);
?>
