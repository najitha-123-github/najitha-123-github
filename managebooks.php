
<html>
<head>  
    <link rel="stylesheet" href="managebooks.css">
    <!-- <link rel="stylesheet" href="admin.css"> -->
    <!-- <title>LOGIN</title> -->
</head>
<body>
    <nav class="nanbar">
        <div class="navbar">
            <a href="#">ONLINE LIBRARY MANAGEMENT SYSTEM</a>
            <div class="link">
                <a href="admin.html">Home</a>
                

            </div>
        </div>
    </nav>
    <div class="div1">
    <h1>Add Books</h1>
        <form class="form1" action="" method="post">
            <input class="input1" type="text" name="title" placeholder="title" required>
            <input class="input1" type="text" name="author" placeholder="author" required>
            <input class="input1" type="number" name="year" placeholder="published year" required>
            <input class="input1" type="text" name="genre" placeholder="genre" required>
            <input class="sub2" type="submit" name="submit" value="submit">
        </form>

<?php
$conn = mysqli_connect("localhost", "root", "", "online_library_management_system");
if (!$conn) {
    echo "Database connection failed:";
    exit();

}

if (isset($_POST['submit'])) { 
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    
$sql ="INSERT INTO `books`( `title`, `author`, `published_year`, `genre`) VALUES ('$title','$author','$year','$genre')";
        $data = mysqli_query($conn, $sql);
        if ($data) {
            echo "<script>alert('Record added');</script>";
        } else {
            echo "<script>alert('Record invalid');</script>";
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
    $sql = "SELECT * FROM `books`";
    $data=mysqli_query($conn,$sql);
    if(mysqli_num_rows($data)>0){  
        echo "<table border=1 >";
        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Author</th>";
        echo "<th>Published year</th>";
        echo "<th>Genre</th>";
        echo "<th>Book id</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($data)){
            $id= $row['book_id'];
            echo "<tr>";
            echo "<td>".$row['title']."</td>";
            echo "<td>".$row['author']."</td>";
            echo "<td>".$row['published_year']."</td>";
            echo "<td>".$row['genre']."</td>";
            echo "<td>".$row['book_id']."</td>";
            echo "<td>
            <form method='POST' style='display:inline;'>
                <button value='$id' name='userdel' type='submit'>Delete</button>
            </form>
    // <td><form method='post' action='staffedit.php'><button value='{$id}' name='staffedit' class='deluser' type='submit'>EDIT</button></form></td>";

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
    $book_id = $_POST['userdel'];
    if(!empty($_POST['userdel'])){
        $sql = "DELETE FROM `books` WHERE book_id= $id";
        $data = mysqli_query($conn, $sql);
        echo "<script>window.location.replace('./managebooks.php');</script>";
    }
}
?>
