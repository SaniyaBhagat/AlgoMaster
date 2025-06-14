<?php
session_start();
include('db_config.php');


if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $algorithm_name = $_POST['algorithm_name'];

    $activity_name = "Add to Choice";
    $activity_info = "User added " . $algorithm_name . " to choice.";
    $activity_time = date("Y-m-d H:i:s");
    $activity_status = "Completed";


    $sql = "INSERT INTO user_activities (user_ID, activity_name, activity_info, activity_time, activity_status, algorithm_name) 
            VALUES ('$user_id', '$activity_name', '$activity_info', '$activity_time', '$activity_status', '$algorithm_name')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
    alert('Algorithm added to choice successfully!');
    window.location.href = '../frontend/visualizer.html';
  </script>";




} else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?> 
