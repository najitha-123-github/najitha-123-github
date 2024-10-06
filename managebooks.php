<!DOCTYPE html>
<html>
<head>  
    <link rel="stylesheet" href="managebooks.css">
    <title>Manage Books</title>
</head>
<body>
    <nav class="navbar">
        <div class="navbar">
            <a href="#">ONLINE LIBRARY MANAGEMENT SYSTEM</a>
            <div class="link">
                <a href="admin.html">Home</a>
            </div>
        </div>
    </nav>
    
    <div class="div1">
        <h1>Add Books</h1>
        <form class="form1" action="" method="post" enctype="multipart/form-data">
            <input class="input1" type="text" name="title" placeholder="Title" required>
            <input class="input1" type="text" name="author" placeholder="Author" required>
            <input class="input1" type="number" name="year" placeholder="Published Year" required>
            <input class="input1" type="text" name="genre" placeholder="Genre" required>
            <input class="input1" type="file" name="photo" required>
            <input class="sub2" type="submit" name="submit" value="Submit">
        </form>

        <?php
        // Database connection
        $conn = mysqli_connect("localhost", "root", "", "online_library_management_system");
        if (!$conn) {
            echo "Database connection failed:";
            exit();
        }

        // Handle form submission
        if (isset($_POST['submit'])) { 
            $title = $_POST['title'];
            $author = $_POST['author'];
            $year = $_POST['year'];
            $genre = $_POST['genre'];
            
            // Handle file upload
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                $photoPath = 'assets/' . basename($_FILES['photo']['name']);
                move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
                
                $sql = "INSERT INTO `books` (`title`, `author`, `published_year`, `genre`, `photo`) VALUES ('$title', '$author', '$year', '$genre', '$photoPath')";
                $data = mysqli_query($conn, $sql);
                if ($data) {
                    echo "<script>alert('Record added');</script>";
                } else {
                    echo "<script>alert('Record invalid');</script>";
                }
            }
        }

        // Fetch and display books
        $sql = "SELECT * FROM `books`";
        $data = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data) > 0) {  
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>Photo</th>";
            echo "<th>Title</th>";
            echo "<th>Author</th>";
            echo "<th>Published Year</th>";
            echo "<th>Genre</th>";
            echo "<th>Book ID</th>";
            echo "<th>Actions</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($data)) {
                $id = $row['book_id'];
                $photoPath = $row['photo'];
                echo "<tr>";
                echo "<td><img src='$photoPath' alt='Book Photo' style='width:100px;height:auto;'></td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['author'] . "</td>";
                echo "<td>" . $row['published_year'] . "</td>";
                echo "<td>" . $row['genre'] . "</td>";
                echo "<td>" . $row['book_id'] . "</td>";
                echo "<td>
                    <form method='POST' style='display:inline;'>
                        <button value='$id' name='userdel' type='submit'>Delete</button>
                    </form>
               <form method='post' action='editbooks.php'>
    <button name='bookedit' value='$id' class='deluser' type='submit'>EDIT</button>
</form>
</td>";
                
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>

        <div class="ViewCandidatesBodyContainer">
            <?php
            
            if (isset($_POST['userdel'])) {
                $book_id = $_POST['userdel'];
                if (!empty($book_id)) {
                    $sql = "DELETE FROM `books` WHERE book_id = $book_id";
                    $data = mysqli_query($conn, $sql);
                    echo "<script>window.location.replace('./managebooks.php');</script>";
                }
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>
