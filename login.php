<?php
include 'connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($stmt);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];
            if (password_verify($password, $hashed_password)) {
                $_SESSION['username'] = $row['username'];
                header('Location: dashboard.php');
                exit();
            } else {
                $error = "Invalid password. Please try again.";
            }
        } else {
            $error = "Invalid username. Please try again.";
        }
    } else {
        echo "Error: " . $stmt . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
<link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>