<?php
session_start();

if (!isset($_SESSION['User_Name']) || $_SESSION['User_Name'] == NULL) {
    echo "<a href='SignIn.php' class='nav-links'><i class='fa fa-user fa-2x'></i></a>";
} else {
    echo '
    <div class="dropdown">
        <a href="#" class="nav-links">'.$_SESSION['User_Name'].'</a>
        <div class="dropdown-content">
            <a href="edit_profile.php" class="nav-links" style="text-align:center;margin-left:0px;">Edit Profile</a>
            <a href="C:\xampp\htdocs\project" onclick="logout(); return false;" class="nav-links" style="text-align:center;margin-left:0px;">Logout</a>
            <a href="add_new.php" class="nav-links" style="text-align:center;margin-left:0px;">Add Blog</a>
        </div>
    </div>
    ';
}
?>
<?php
    require_once "../connection.php";

    if (isset($_POST['blogsubmit'])) {
    $title = $_POST['blogtitle'];
    $content = $_POST['blogcontent'];
    $img = $_POST['filename'];
    $author = $_SESSION['User_Name'];
    $id = $_SESSION['User_ID'];

    // Prepare the SQL statement
    $sql = "INSERT INTO blog (Author, Image, Content, User_ID, Title) VALUES (?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $con->prepare($sql);

    // Bind parameters to the prepared statement
    $stmt->bind_param("sssis", $author, $img, $content, $id, $title);

    // Execute the prepared statement
    if ($stmt->execute()) {
        header("Location: add_new.php");
        exit(); // Ensure that the script stops here after redirection
    } else {
        echo "failed";
    }
}
?>