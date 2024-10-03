<?php
include 'dbbooks.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$id]);
$book = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $published_year = $_POST['published_year'];
    $genre = $_POST['genre'];

    $stmt = $pdo->prepare("UPDATE books SET title = ?, author = ?, published_year = ?, genre = ? WHERE id = ?");
    $stmt->execute([$title, $author, $published_year, $genre, $id]);

    header('Location: indexbooks.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Edit Book</h1>
        <form method="post">
            <label>Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
            <label>Author:</label>
            <input type="text" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
            <label>Published Year:</label>
            <input type="number" name="published_year" value="<?php echo htmlspecialchars($book['published_year']); ?>">
            <label>Genre:</label>
            <input type="text" name="genre" value="<?php echo htmlspecialchars($book['genre']); ?>">
            <input class="btn" type="submit" value="Update Book">
        </form>
        <a class="btn" href="indexbooks.php">Back to Books</a>
    </div>
</body>
</html>
