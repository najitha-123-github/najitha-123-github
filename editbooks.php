<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "online_library_management_system");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if (isset($_POST['bookedit'])) {
    $id = $_POST['bookedit']; // Get the book ID from the button value
    // Fetch the book details
    $result = mysqli_query($conn, "SELECT * FROM books WHERE book_id = '$id'");
    if (!$result) {
        die("Error fetching book details: " . mysqli_error($conn));
    }

    $book = mysqli_fetch_assoc($result);
    if (!$book) {
        die("No book found with the provided ID.");
    }

    // Handle the form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        // Getting the input values from the form
        $title = $_POST['title'];
        $author = $_POST['author'];
        $published_year = $_POST['published_year'];
        $genre = $_POST['genre'];

        // Update the book details
        $updateQuery = "UPDATE books SET title = '$title', author = '$author', published_year = '$published_year', genre = '$genre' WHERE book_id = '$id'";
        if (!mysqli_query($conn, $updateQuery)) {
            die("Error updating book: " . mysqli_error($conn));
        }

        header('Location: managebooks.php');
        exit();
    }
} else {
    die("No book ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="editbook.css">
</head>
<body>
    <div class="container">
        <h1>Edit Book</h1>
        <form method="post">
            <input type="hidden" name="bookedit" value="<?php echo htmlspecialchars($id); ?>">
            <label>Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
            <label>Author:</label>
            <input type="text" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
            <label>Published Year:</label>
            <input type="number" name="published_year" value="<?php echo htmlspecialchars($book['published_year']); ?>">
            <label>Genre:</label>
            <input type="text" name="genre" value="<?php echo htmlspecialchars($book['genre']); ?>">
            <input class="btn" type="submit" name="update" value="Update Book">
        </form>
        <a class="btn" href="managebooks.php">Back to Books</a> 
    </div>
</body>
</html>
