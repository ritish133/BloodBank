<?php
include 'connect.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

$query = "SELECT blood, COUNT(*) as count FROM users GROUP BY blood";
$result = $conn->query($query);

$bloodGroups = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $bloodGroups[$row['blood']] = $row['count'];
    }
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <h2>Number of Users by Blood Group</h2>
        <table>
            <thead>
                <tr>
                    <th>Blood Group</th>
                    <th>Number of Users</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bloodGroups as $bloodGroup => $count): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($bloodGroup); ?></td>
                        <td><?php echo htmlspecialchars($count); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form action="" method="POST">
            <button type="submit" class="btn" name="logout">Logout</button>
        </form>
    </div>
</body>
</html>