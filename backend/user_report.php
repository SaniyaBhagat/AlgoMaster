<?php
session_start();
include('db_config.php');


if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in.";
    exit();
}


$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];


$total_visualized = 0;
$total_added_to_choice = 0;
$total_explored = 0;


$sql_total_visualized = "SELECT COUNT(*) AS total_visualized FROM user_activities WHERE user_ID = '$user_id' AND activity_name = 'Add to Visualizer'";
$result_total_visualized = $conn->query($sql_total_visualized);
if ($result_total_visualized && $result_total_visualized->num_rows > 0) {
    $total_visualized = $result_total_visualized->fetch_assoc()['total_visualized'];
}

$sql_total_explored = "SELECT COUNT(*) AS total_explored FROM user_progress WHERE user_ID = '$user_id'";
$result_total_explored = $conn->query($sql_total_explored);
$total_explored = ($result_total_explored->num_rows > 0) ? $result_total_explored->fetch_assoc()['total_explored'] : 0;


$sql_total_explored = "SELECT COUNT(DISTINCT algorithm_name) AS total_explored FROM user_progress WHERE user_ID = '$user_id'";
$result_total_explored = $conn->query($sql_total_explored);
$total_explored = ($result_total_explored && $result_total_explored->num_rows > 0) ? $result_total_explored->fetch_assoc()['total_explored'] : 0;

$sql_total_added_to_choice = "SELECT COUNT(*) AS total_added_to_choice FROM user_activities WHERE user_ID = '$user_id' AND activity_name = 'Add to Choice'";
$result_total_added_to_choice = $conn->query($sql_total_added_to_choice);
$total_added_to_choice = ($result_total_added_to_choice->num_rows > 0) ? $result_total_added_to_choice->fetch_assoc()['total_added_to_choice'] : 0;


$sql_feedback = "SELECT feedback_text, review_score, submitted_at FROM feedback WHERE user_ID = '$user_id'";
$result_feedback = $conn->query($sql_feedback);

// Fetch user activities (Algorithms added to Visualizer)
$sql_visualizer = "SELECT algorithm_name, activity_info, activity_time FROM user_activities WHERE user_ID = '$user_id' AND activity_name = 'Add to Visualizer'";
$result_visualizer = $conn->query($sql_visualizer);

// Fetch user activities (Algorithms added to Choice)
$sql_choice = "SELECT algorithm_name, activity_info, activity_time FROM user_activities WHERE user_ID = '$user_id' AND activity_name = 'Add to Choice'";
$result_choice = $conn->query($sql_choice);

// Calculate Completion Date (latest algorithm used)
$sql_completion_date = "SELECT MAX(last_used) AS completion_date FROM user_progress WHERE user_ID = '$user_id'";
$result_completion_date = $conn->query($sql_completion_date);
$completion_date = ($result_completion_date->num_rows > 0) ? $result_completion_date->fetch_assoc()['completion_date'] : 'Not Available';

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Activity Report</title>
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
            color: #5a0d0d;
            padding-bottom: 20px;
            margin-bottom: 40px;
        }

        h2 {
            color: #8b0000;
            text-align: center;
            font-size: 28px;
            /* margin-bottom: 30px; */
            /* padding-bottom: 10px; */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            /* margin-top:20px; */
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
            color: #000;
            font-size: 22px;
        }

        tr:nth-child(even) {
            background-color:rgb(255, 255, 255);
        }

        .submit-btn {
            display: block;
            margin: 0 auto 30px;
            background-color: #C52F2F;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 28px;
            padding: 12px 40px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #aa2424;
        }

        .logout {
            text-align: center;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            margin: 30px;
        }

        .logout button {
            padding: 15px;
            margin-top: 5px;
            font-size: 25px;
            color: rgb(0, 0, 0);
            border: none;
        }

        .logout button:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>User Activity Report for <?php echo $user_name; ?></h1>

    <h2>1. Algorithms Added to Visualizer</h2>
    <table>
        <tr>
            <th>Algorithm Name</th>
            <th>Activity Info</th>
            <th>Timestamp</th>
        </tr>
        <?php
        if ($result_visualizer->num_rows > 0) {
            while ($row = $result_visualizer->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['algorithm_name'] . "</td>
                        <td>" . $row['activity_info'] . "</td>
                        <td>" . $row['activity_time'] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No algorithms added to visualizer yet.</td></tr>";
        }
        ?>
    </table>

    <h2>2. Algorithms Added to Choice</h2>
    <table>
        <tr>
            <th>Algorithm Name</th>
            <th>Activity Info</th>
            <th>Timestamp</th>
        </tr>
        <?php
        if ($result_choice->num_rows > 0) {
            while ($row = $result_choice->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['algorithm_name'] . "</td>
                        <td>" . $row['activity_info'] . "</td>
                        <td>" . $row['activity_time'] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No algorithms added to choice yet.</td></tr>";
        }
        ?>
    </table>

    <h2>3. Overall Progress & Stats</h2>
    <table>
        <tr>
            <th>Total Algorithms Explored</th>
            <th>Algorithms Visualized</th>
            <th>Algorithms Added to Choice</th>
            <th>Completion Date</th>
        </tr>
        <tr>
            <td><?php echo $total_explored; ?></td>
            <td><?php echo $total_visualized; ?></td>
            <td><?php echo $total_added_to_choice; ?></td>
            <td><?php echo $completion_date; ?></td>
        </tr>
    </table>

    <h2>4. Feedback Submitted</h2>
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
            echo "<tr><td colspan='3'>No feedback submitted yet.</td></tr>";
        }
        ?>
    </table>

    <form action="../backend/user_progress.php" method="POST">
        <input type="hidden" name="algorithm_name" value="Save Progress">
        <input type="submit" class="submit-btn" value="Save Progress">

    </form>

    <h2>Thank you for using AlgoMaster!<sty></h2>

    <div class="logout">
        <button onclick="window.location.href='../backend/user_logout.php'">LOGOUT</button>
    </div>
</body>
</html>
