<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gym Fitness Hub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
session_start();
include "connect.php";

if(isset($_POST["login"])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tbl_users WHERE username='$username' AND password='$password'";

    $result = $conn -> query($sql);

    if($result -> num_rows == 1){
        $row = $result->fetch_assoc();

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];

        if($row['role'] == 'admin'){
            header('Location: admin_dashboard.php');
        } else {
            header('Location: member_dashboard.php');
        }
    } else {
        echo "Invalid Login";
    }
}
?>

    <div class="login-container">
        <h2>Login to Your Account</h2>
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit" name="login" class="btn">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Sign up here</a></p>
    </div>
</body>
</html>