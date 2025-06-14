<?php
include('db_config.php');


ob_start();  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $check_email = "SELECT * FROM users WHERE user_email = '$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
        echo "Error: Email already exists. Please use a different email.";
    } else {
       
        $name = $_POST['name'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
        $age = $_POST['age'];

       
        $sql = "INSERT INTO users (user_Name, password, user_email, user_age) 
                VALUES ('$name', '$password', '$email', '$age')";

        if ($conn->query($sql) === TRUE) {

            header("Location: ../frontend/user_login.html");

            exit();
            

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}

ob_end_flush();  
?>
