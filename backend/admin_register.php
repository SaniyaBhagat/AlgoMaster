<?php
include('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    
    $check_email = "SELECT * FROM admin WHERE admin_email = '$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
        echo "Error: Email already exists. Please use a different email.";
    } else {
        
        $name = $_POST['name'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

        $sql = "INSERT INTO admin (admin_Name, password, admin_email) 
                VALUES ('$name', '$password', '$email')";

        if ($conn->query($sql) === TRUE) {
           
            header("Location: ../frontend/admin_login.html");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>

