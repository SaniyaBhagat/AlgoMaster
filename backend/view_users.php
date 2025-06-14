<?php
include('db_config.php');

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Users - AlgoMaster</title>
  <style>
    body {
      background-color: #f5f5f5;
      font-family: TimesNewRoman;
      margin: 0;
      padding: 0;
    }

    h2 {
      text-align: center;
      font-size: 36px;
      color: #8b0000;
      margin-top: 40px;
      margin-bottom: 30px;
    }

    table {
      width: 85%;
      margin: auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
    }

    th, td {
      padding: 14px 20px;
      border: 1px solid #ccc;
      text-align: center;
      font-size: 20px;
    }

    th {
      background-color: #C52F2F;
      color: #ffffff;
      font-size: 25px;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    a {
    font-size:20px;
      color:red;
      font-weight: 600;
      text-decoration: none;
      transition: color 0.3s;
    }

    a:hover {
      /* color:rgb(245, 225, 225); */
      text-decoration: underline;
    }

    .actions a {
      margin: 0 8px;
    }

    .footer {
      text-align: center;
      padding: 25px;
      font-size: 20px;
      color: black;
    }
  

    .back-btn {
  width: 85%;
  margin: 0 auto 20px auto;
  text-align: left;
}

.back-btn a {
  display: inline-block;
  background-color:rgb(207, 168, 247);
  color: black;
  padding: 10px 20px;
  border-radius: 6px;
  text-decoration: none;
  font-size: 20px;
  transition: background-color 0.3s ease;
}


  </style>
</head>
<body>

  <h2>Registered Users</h2>

  <table>
    <tr>
      <th>User ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Age</th>
      <th>Actions</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?php echo $row['user_ID']; ?></td>
      <td><?php echo $row['user_Name']; ?></td>
      <td><?php echo $row['user_email']; ?></td>
      <td><?php echo $row['user_age']; ?></td>
      <td class="actions">
        <a href="edit_user.php?id=<?php echo $row['user_ID']; ?>">Edit</a> |
        <a href="delete_user.php?id=<?php echo $row['user_ID']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
      </td>
    </tr>
    <?php endwhile; ?>

    <div class="back-btn">
  <a href="admin_index.php">← Back to Admin Dashboard</a>
</div>

  </table>

  <div class="footer">
    © 2025 AlgoMaster Admin Panel
  </div>

</body>
</html>

<?php $conn->close(); ?>
