<?php
session_start();
include('db_config.php');


if (!isset($_SESSION['admin_id'])) {
    echo "Admin is not logged in.";
    exit();
}


if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    echo "No user ID provided.";
    exit();
}


$sql_user_info = "SELECT user_name FROM users WHERE user_id = '$user_id'";
$result_user_info = $conn->query($sql_user_info);
$user_name = ($result_user_info->num_rows > 0) ? $result_user_info->fetch_assoc()['user_name'] : 'Unknown User';


$sql_activities = "SELECT * FROM user_activities WHERE user_ID = '$user_id'";
$result_activities = $conn->query($sql_activities);

$sql_feedback = "SELECT feedback_text, review_score, submitted_at FROM feedback WHERE user_ID = '$user_id'";
$result_feedback = $conn->query($sql_feedback);

if (isset($_POST['delete_user'])) {
    $sql_delete = "DELETE FROM users WHERE user_id = '$user_id'";
    $conn->query($sql_delete);
    header('Location: admin_report.php');  
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Report for <?php echo $user_name; ?></title>
    <style>
        <style>
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
            margin-top: 40px;
        }
        .back-btn a {
            background-color:rgb(223, 174, 249);
            color: black;
            text-decoration: none;
            padding: 10px 20px;
            font-size:25px;
            margin-top:20px;
            border-radius: 6px;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 40px;
            background-color: rgb(255, 255, 255);
        }

        h1 {
            text-align: center;
            font-size: 35px;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            color: #5a0d0d;
            padding-bottom: 20px;
            margin-bottom: 40px;
        }

        h2 {
            text-align: center;
            color: #5a0d0d;
            font-size: 28px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 16px;
            text-align: left;
            border: 1.5px solid #444;
            font-size: 20px;
        }

        th {
            background-color:rgb(226, 218, 247);
        }

        .delete-btn {
            background-color:rgb(227, 137, 243);
            color: black;
            border: none;
            padding: 12px 20px;
            font-size: 20px;
            cursor: pointer;
            text-align: center;
            display: block;
            margin: 20px auto;
            border-radius: 6px;
            margin-bottom:10px;
        }

       

        
    </style>
</head>
<body>

<h1>Admin Report for <?php echo $user_name; ?></h1>

<h2>1. User Activities</h2>
<table>
    <tr>
        <th>Algorithm Name</th>
        <th>Activity Info</th>
        <th>Timestamp</th>
    </tr>
    <?php
    if ($result_activities->num_rows > 0) {
        while ($row = $result_activities->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['algorithm_name'] . "</td>
                    <td>" . $row['activity_info'] . "</td>
                    <td>" . $row['activity_time'] . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No activities found for this user.</td></tr>";
    }
    ?>
</table>

<h2>2. User Feedback</h2>
<table>
    <tr>
        <th>Feedback Text</th>
        <th>Review Score</th>
        <th>Submitted At</th>
    </tr>
    <?php
    if ($result_feedback->num_rows > 0) {
        while ($row = $result_feedback->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['feedback_text'] . "</td>
                    <td>" . $row['review_score'] . "</td>
                    <td>" . $row['submitted_at'] . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No feedback found for this user.</td></tr>";
    }
    ?>
</table>

<form method="POST" onsubmit="return confirm('Are you sure you want to delete this user and their data?')">
    <button type="submit" name="delete_user" class="delete-btn">Delete User and Their Data</button>
</form>

    <div class="back-btn">
    <a href="admin_report.php">← Back to Admin Reports</a>
    <br>
</div>
<div class="back-btn">
    <a href="admin_index.php">← Back to Admin Dashboard</a>
</div>


</body>
</html>
