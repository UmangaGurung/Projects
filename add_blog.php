<?php
session_start();
require_once "connection.php";

if (isset($_POST['blogsubmit'])) {
    $title = $_POST['blogtitle'];
    $content = $_POST['blogcontent'];
    $img = $_POST['filename'];
    $author = $_SESSION['User_Name'];
    $id = $_SESSION['User_ID'];

    // Prepare and execute the SQL query using prepared statements
    $sql = "INSERT INTO blog (`Author`, `Image`, `Content`, `User_ID`, `Title`)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssiss", $author, $img, $content, $id, $title);

    if ($stmt->execute()) {
        header("Location: templates/home_first.php");
        exit;
    } else {
        echo "Failed to insert blog into the database.";
    }

    $stmt->close();
}
?>
