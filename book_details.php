<?php
$conn = mysqli_connect("localhost", "root", "", "online_library_management_system");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the book ID from the URL
$book_id = isset($_GET['book_id']) ? intval($_GET['book_id']) : 0;

// Fetch the book details
$sql = "SELECT * FROM books WHERE book_id = $book_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $book = mysqli_fetch_assoc($result);
} else {
    echo "Book not found.";
    exit;
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="book_details.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($book['title']); ?> Details</title>
</head>

<body>
    <nav>
        <div class="navbar">
            <a href="">Library Management System</a>
            <div class="link">
                <a href="">Home</a>
                <a href="./book_action.php">Booking</a>
                <a href="">Returning</a>
                <a href="">Logout</a>
                <a href="./login.html"></a>
            </div>
        </div>
    </nav>
    
    <div class="doc">
        <h1><?php echo htmlspecialchars($book['title']); ?></h1>
        <img src="<?php echo htmlspecialchars($book['photo']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" style="max-width: 300px; height: auto;">
        <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
        <p>Published Year: <?php echo htmlspecialchars($book['published_year']); ?></p>
        <p>Genre: <?php echo htmlspecialchars($book['genre']); ?></p>

        <h2>Book Now</h2>
        <form action="book_action.php" method="POST">
            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['book_id']); ?>">
            <label for="duration">Select Duration:</label>
            <select name="duration" id="duration">
                <option value="1_week">1 Week</option>
                <option value="2_weeks">2 Weeks</option>
                <option value="1_month">1 Month</option>
            </select>
            <button type="submit">Book</button>
        </form>
    </div>

</body>
</html>
