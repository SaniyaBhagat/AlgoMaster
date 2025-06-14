<?php
session_start();
include('db_config.php');


if (!isset($_SESSION['admin_id'])) {
    echo "Access denied. Admin not logged in.";
    exit();
}

// Fetch all feedback records
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Feedback - Admin Panel</title>
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
</head>
<body>

<h2>All Feedback Submissions</h2>

<table>
    <tr>
        <th>User ID</th>
        <th>User Name</th>
        <th>Feedback</th>
        <th>Review Score</th>
        <th>Submitted At</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['user_ID']; ?></td>
        <td><?php echo $row['user_Name']; ?></td>
        <td><?php echo $row['feedback_text']; ?></td>
        <td><?php echo $row['review_score']; ?></td>
        <td><?php echo $row['submitted_at']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<div class="back-btn">
    <a href="admin_index.php">← Back to Admin Dashboard</a>
</div>

</body>
</html>

<?php $conn->close(); ?>

