<?php
session_start();
include('db_config.php');


if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in.";
    exit();
}

$user_id = $_SESSION['user_id'];


if (isset($_POST['algorithm_name']) && !empty($_POST['algorithm_name'])) {
    $algorithm_name = $_POST['algorithm_name'];
} else {
    echo "Algorithm name not provided.";
    exit();
}

$progress_status = isset($_POST['progress_status']) ? $_POST['progress_status'] : 'In Progress';
$last_used = date('Y-m-d H:i:s');


$sql_check = "SELECT * FROM user_progress WHERE user_ID = '$user_id' AND algorithm_name = '$algorithm_name'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
   
    $sql_update = "UPDATE user_progress 
                   SET progress_status = '$progress_status', last_used = '$last_used'
                   WHERE user_ID = '$user_id' AND algorithm_name = '$algorithm_name'";
    $conn->query($sql_update);
} else {
   
    $sql_insert = "INSERT INTO user_progress (user_ID, algorithm_name, progress_status, last_used) 
                   VALUES ('$user_id', '$algorithm_name', '$progress_status', '$last_used')";
    $conn->query($sql_insert);
}

echo "<script>alert('Progress recorded successfully!'); window.location.href = 'user_report.php';</script>";

$conn->close();
?>