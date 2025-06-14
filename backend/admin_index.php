<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
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
            margin: 0;
            padding: 0;
         font-family: TimesNewRoman; 
            background-color:rgb(237, 219, 250);
        }

        .dashboard {
            max-width: 1200px;
            margin: 60px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 6px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            height:600px;
        }

        h1 {
            font-size: 36px;
            color: #2b2b2b;
            margin-bottom: 10px;
        }

        p {
            font-size: 25px;
            color: black;
            margin-bottom: 35px;
        }

        ul {
            list-style: none;
            padding: 10px;
        }

        ul li {
            margin: 18px 0;
        }

        ul li a {
            display: inline-block;
            padding: 12px 30px;
            font-size: 25px;
            color:black;
            background-color:rgb(237, 214, 248);
            border-radius: 4px;
            font-family:Franklin;
            transition: all 0.3s ease-in-out;
        }

        ul li a:hover {
            transition: all 0.3s ease-in-out;
            text-decoration: underline;
        
        } 

        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 25px;
            color: black;
        }
    </style>
</head>
<body>

<div class="dashboard">
    <h1>Welcome, Admin!</h1>
    <p>This is the Admin Dashboard. You can manage users, view reports, and perform administrative tasks here.</p>

    <ul>
        <li><a href="../backend/view_users.php">View All Users</a></li>
        <li><a href="../backend/admin_feedback.php">View Feedback</a></li>
        <li><a href="../backend/admin_report.php">View Reports</a></li>
        <li><a href="../backend/admin_logout.php">Logout</a></li>
    </ul>
<br>
<br>
    <footer>
    &copy; 2025 AlgoMaster Admin Panel | All Rights Reserved
</footer>
</div>

</body>
</html>
