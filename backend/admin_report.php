<?php
session_start();
include('db_config.php');


if (!isset($_SESSION['admin_id'])) {
    echo "Admin is not logged in.";
    exit();
}


$sql_users = "SELECT user_id, user_name FROM users";
$result_users = $conn->query($sql_users);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Report - User Activity</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 40px;
            background-color: rgb(255, 255, 255);
        }

        h1 {
            text-align: center;
            font-size: 35px;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            color:rgb(213, 1, 1);
            padding-bottom: 20px;
            margin-bottom: 40px;
        }

        .user-list {
            list-style: none;
            padding: 0;
            text-align: center;
        }

        .user-list li {
            padding: 12px;
            font-size: 30px;
            margin-bottom: 12px;
            border: 2px solid #ddd;
            display: inline-block;
            background-color: #f4f4f4;
            cursor: pointer;
        }

        .user-list li:hover {
            background-color: #ddd;
        }

        .delete-btn {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #d9534f;
            color: white;
            border: none;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #c9302c;
        }

     
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 40px;
            background-color: #f9f9f9;
        }
        h2 {
            color:rgb(139, 2, 2);
            text-align: center;
            font-size:28px;
            font-family:Franklin;
            margin-bottom: 30px;
        }
        table {
            width: 90%;
            border-collapse: collapse;
            margin: 0 auto 40px;
        }
        th, td {
            padding: 12px 18px;
            border: 1px solid #333;
            text-align: left;
            font-size: 18px;
        }
        th {
            background-color:rgb(247, 187, 248);
            font-size:20px;
        }

        tr:nth-child(even) {
            background-color: #f0f0f0;
        }
        .back-btn {
            text-align: center;
            margin-top: 20px;
        }
        .back-btn a {
            background-color:rgb(223, 174, 249);
            color: black;
            text-decoration: none;
            padding: 10px 20px;
            font-size:25px;
            border-radius: 6px;
        }

    </style>
    </style>
</head>
<body>

<h1>Admin Report Panel</h1>

<h2>List of User Reports</h2>

<ul class="user-list">
    <?php
    if ($result_users->num_rows > 0) {
        while ($row = $result_users->fetch_assoc()) {
            echo "<li><a href='viewuser_report.php?user_id=" . $row['user_id'] . "'>" . $row['user_name'] . "</a></li>";
        }
    } else {
        echo "<li>No users found.</li>";
    }
    ?>
</ul>


<div class="back-btn">
    <a href="admin_index.php">← Back to Admin Dashboard</a>
</div>

</body>
</html>

