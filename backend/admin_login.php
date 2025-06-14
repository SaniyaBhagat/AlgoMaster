<?php
session_start(); 
include('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE admin_email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
          
            $_SESSION['admin_id'] = $row['admin_ID'];
            $_SESSION['admin_name'] = $row['admin_Name'];
            

            header("Location: ../backend/admin_index.php");
            exit();
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "No admin found with this email.";
    }

    $conn->close();
}
