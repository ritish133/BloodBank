<?php 
include 'connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $blood_group = $_POST['blood_group'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = "INSERT INTO users (username, password, email, blood) VALUES ('$username','$hashed_password','$email','$blood_group')";
    if($conn->query($stmt)===TRUE){
        echo "New record added successfully";
        header("refresh:3;url=login.php");
    }
    else {
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
    <title>Sign Up</title>
<link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <form action="signup.php" method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <select name="blood_group" required>
                    <option value="">Select Blood Group</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>
            <button type="submit" class="btn">Sign Up</button>
        </form>
    </div>
</body>
</html>