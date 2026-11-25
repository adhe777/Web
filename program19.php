<!DOCTYPE html>
<html>
<head>
    <title>Book Details</title>
</head>

<body>

    <h2>Enter Book Details</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <label for="book_no">Book No:</label>
        <input type="number" name="book_no" required>
        <br><br>

        <label for="title">Title:</label>
        <input type="text" name="title" required>
        <br><br>

        <label for="edition">Edition:</label>
        <input type="text" name="edition" required>
        <br><br>

        <label for="publisher">Publisher:</label>
        <input type="text" name="publisher" required>
        <br><br>

        <input type="submit" value="Add Book">

    </form>

</body>
</html>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";


$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";

if (mysqli_query($conn, $sql_create_db)) {
    echo "Database created successfully.<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}


mysqli_select_db($conn, $dbname);


$sql_create_table = "CREATE TABLE IF NOT EXISTS book_details (
    book_no INT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    edition VARCHAR(50) NOT NULL,
    publisher VARCHAR(100) NOT NULL
)";

if (mysqli_query($conn, $sql_create_table)) {
    echo "Table created successfully.<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $book_no = $_POST["book_no"];
    $title = $_POST["title"];
    $edition = $_POST["edition"];
    $publisher = $_POST["publisher"];


    $check = "SELECT book_no FROM book_details WHERE book_no = ?";

    $stmt = mysqli_prepare($conn, $check);
    mysqli_stmt_bind_param($stmt, "i", $book_no);
    mysqli_stmt_execute($stmt);

    $result_check = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result_check) > 0) {

        echo "<p style='color:red;'>Book number already exists!</p>";

    } else {


        $sql_insert = "INSERT INTO book_details
        (book_no, title, edition, publisher)
        VALUES (?, ?, ?, ?)";

        $stmt_insert = mysqli_prepare($conn, $sql_insert);

        mysqli_stmt_bind_param(
            $stmt_insert,
            "isss",
            $book_no,
            $title,
            $edition,
            $publisher
        );

        if (mysqli_stmt_execute($stmt_insert)) {
            echo "<p style='color:green;'>Book information added successfully.</p>";
        } else {
            echo "Error inserting book: " . mysqli_stmt_error($stmt_insert);
        }

        mysqli_stmt_close($stmt_insert);
    }

    mysqli_stmt_close($stmt);
}


$result = mysqli_query($conn, "SELECT * FROM book_details");

if (mysqli_num_rows($result) > 0) {

    echo "<h2>Book Details:</h2>";

    echo "<table border='1' cellpadding='5'>";

    echo "<tr>
        <th>Book No</th>
        <th>Title</th>
        <th>Edition</th>
        <th>Publisher</th>
    </tr>";

    while ($row = mysqli_fetch_assoc($result)) {

        echo "<tr>
            <td>{$row['book_no']}</td>
            <td>" . htmlspecialchars($row['title']) . "</td>
            <td>" . htmlspecialchars($row['edition']) . "</td>
            <td>" . htmlspecialchars($row['publisher']) . "</td>
        </tr>";
    }

    echo "</table>";

} else {

    echo "No books found.";

}

mysqli_close($conn);

?>



