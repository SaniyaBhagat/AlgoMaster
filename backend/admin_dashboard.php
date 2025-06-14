<?php
session_start();
if (!isset($_SESSION['admin_ID'])) {
    echo "You need to log in first!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - AlgoMaster</title>
    <style>
        body {
            background-color: #f7f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            max-width: 600px;
            margin: 80px auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #2e2e2e;
            font-size: 32px;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            font-size: 18px;
            margin-bottom: 40px;
        }

        .dashboard-links a {
            display: block;
            padding: 15px 0;
            margin: 10px auto;
            background-color: #4e73df;
            color: white;
            text-decoration: none;
            font-size: 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .dashboard-links a:hover {
            background-color: #2c50b0;
        }

        .logout {
            margin-top: 30px;
        }

        .logout a {
            font-size: 18px;
            color: #d9534f;
            text-decoration: underline;
        }

        .logout a:hover {
            color: #b02a2a;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['admin_Name']; ?>!</h2>
        <p>This is the Admin Dashboard. You can manage users, view reports, and monitor activities.</p>

        <div class="dashboard-links">
            <a href="edit_users.php">Manage Users</a>
            <a href="user_report.php">View User Reports</a>
        </div>

        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>

</body>
</html>
