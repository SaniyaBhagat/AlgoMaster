<?php
session_start(); 
include('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM users WHERE user_email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            
            $_SESSION['user_id'] = $row['user_ID'];
            $_SESSION['user_name'] = $row['user_Name'];
            
        
            header("Location: ../frontend/index.html");

exit();

            

        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "No user found with this email.";
    }

    $conn->close();
}
?>  



<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];


$conn = new mysqli("localhost", "root", "", "algomaster");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {

    
    $_SESSION['email'] = $email;
    header("Location: ../index.html");  
    exit();
} else {
    echo "<script>alert('Invalid credentials!'); window.location.href='../login.html';</script>";
}

$conn->close();
?>

