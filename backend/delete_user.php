<?php
include('db_config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE user_ID = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_users.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
