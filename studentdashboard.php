<?php
$conn = mysqli_connect("localhost", "root", "", "online_library_management_system");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch the genres for the dropdown
$genreSql = "SELECT DISTINCT genre FROM books";
$genreResult = mysqli_query($conn, $genreSql);
$genres = [];
if (mysqli_num_rows($genreResult) > 0) {
    while ($row = mysqli_fetch_assoc($genreResult)) {
        $genres[] = $row['genre'];
    }
}

// Handle search and filter
$searchTitle = '';
$selectedGenre = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchTitle = $_POST['search'] ?? '';
    $selectedGenre = $_POST['genre'] ?? '';
}

// Prepare the SQL query
$sql = "SELECT * FROM books WHERE title LIKE '%$searchTitle%'";

if ($selectedGenre) {
    $sql .= " AND genre = '$selectedGenre'";
}

$result = mysqli_query($conn, $sql);

$books = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }
} else {
    echo "No books found.";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="studentdashboard.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
</head>

<body>
<nav class="navbar">
    <div class="navbar">
        <a href="index.html" class="navbar-title">Library Management System</a>
        <div class="link">
            <a href="View_bookings.php">Booking</a>
            <a href="returning.php">Returning</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="doc">
    <h1>Student Dashboard</h1>
</div>

<div class="search-filter">
    <form method="POST" action="">
        <input type="text" name="search" placeholder="Search by title" value="<?php echo htmlspecialchars($searchTitle); ?>">
        <select name="genre">
            <option value="">All Genres</option>
            <?php foreach ($genres as $genre): ?>
                <option value="<?php echo htmlspecialchars($genre); ?>" <?php if ($selectedGenre === $genre) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($genre); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Search">
    </form>
</div>

<div class="book-grid">
    <?php foreach ($books as $book): ?>
        <div class="book-item">
            <img src="<?php echo htmlspecialchars($book['photo']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
            <h3><?php echo htmlspecialchars($book['title']); ?></h3>
            <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
            <p>Published Year: <?php echo htmlspecialchars($book['published_year']); ?></p>
            <p>Genre: <?php echo htmlspecialchars($book['genre']); ?></p>
            <button><a style="color:white;text-decoration:none;" href="book_details.php?book_id=<?php echo urlencode($book['book_id']); ?>" class="button">View Details</a>
            </button>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
