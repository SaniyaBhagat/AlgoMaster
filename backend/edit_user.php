<?php
include('db_config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE user_ID = $id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $sql = "UPDATE users SET user_Name='$name', user_email='$email', user_age='$age' WHERE user_ID=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_users.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User - Admin | AlgoMaster</title>
  <style>
    body {
      background-color: #f2f6fc;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    .container {
      background-color: #ffffff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      width: 420px;
    }

    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 25px;
      font-size: 32px;
    }

    label {
      font-size: 20px;
      font-weight: 600;
      color: #333;
      display: block;
      margin-top: 12px;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"] {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      width: 100%;
      background-color: #512da8;
      color: white;
      font-size: 18px;
      padding: 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-top: 10px;
    }

    input[type="submit"]:hover {
      background-color: #4527a0;
    }

    .back-link {
      text-align: center;
      margin-top: 20px;
    }

    .back-link a {
      text-decoration: none;
      color: black;
      font-size: 20px;
    }

    .back-link a:hover {
      text-decoration: underline;
      color: #000;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Edit User</h2>
    <form method="POST">
      <label for="name">Name:</label>
      <input type="text" name="name" value="<?php echo $user['user_Name']; ?>" required>

      <label for="email">Email:</label>
      <input type="email" name="email" value="<?php echo $user['user_email']; ?>" required>

      <label for="age">Age:</label>
      <input type="number" name="age" value="<?php echo $user['user_age']; ?>" required>

      <input type="submit" value="Update">
    </form>
    <div class="back-link">
      <a href="view_users.php">← Back to User List</a>
    </div>
  </div>
</body>
</html>
