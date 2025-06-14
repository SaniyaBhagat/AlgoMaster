<?php
session_start();
include('db_config.php');


if (!isset($_SESSION['admin_id'])) {
    echo "<script>alert('Admin is not logged in. Please log in first.'); window.location.href = 'admin_login.php';</script>";
    exit();
}


$sql = "SELECT f.feedback_ID, u.user_name, u.user_email, f.feedback_text, f.review_score, f.submitted_at 
        FROM feedback f 
        INNER JOIN users u ON f.user_ID = u.user_ID
        ORDER BY f.submitted_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View User Feedbacks - Admin Panel</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 80%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        h2 { color: #333; }
    </style>
</head>
<body>
    <h1>All User Feedbacks</h1>

    <table>
        <tr>
            <th>Feedback ID</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>Feedback</th>
            <th>Review Score</th>
            <th>Submitted At</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['feedback_ID'] . "</td>
                        <td>" . $row['user_name'] . "</td>
                        <td>" . $row['user_email'] . "</td>
                        <td>" . $row['feedback_text'] . "</td>
                        <td>" . $row['review_score'] . "</td>
                        <td>" . $row['submitted_at'] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No feedbacks found.</td></tr>";
        }
        ?>
    </table>

    <a href="admin_index.php">Back to Admin Dashboard</a>
</body>
</html>

<?php
$conn->close();
?>
