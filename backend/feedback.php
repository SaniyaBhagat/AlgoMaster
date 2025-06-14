<?php
session_start();
include('db_config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in.";
    exit();
}

// Get user ID and name from session
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Check if feedback form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['feedback_text']) && isset($_POST['review_score'])) {

        $feedback_text = $conn->real_escape_string($_POST['feedback_text']);
        $review_score = (int)$_POST['review_score'];

        $sql = "INSERT INTO feedback (user_ID, user_name, feedback_text, review_score) 
                VALUES ('$user_id', '$user_name', '$feedback_text', '$review_score')";

        if ($conn->query($sql) === TRUE) {
            echo "Feedback submitted successfully!";
            header("Location: ../backend/user_report.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Please fill out all fields.";
    }
}

$conn->close();
?>
