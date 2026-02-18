<?php
include "connect.php";

$error = "";
$success = "";

if (isset($_POST['register'])) {

    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($username) || empty($password) || empty($role)) {

        $error = "All fields are required.";

    } elseif (strlen($password) < 6) {

        $error = "Password must be at least 6 characters.";

    } else {

        $stmt = $conn->prepare("SELECT id FROM tbl_users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $error = "Username already exists.";

        } else {

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO tbl_users (username, password, role) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashed_password, $role);

            if ($stmt->execute()) {

                $success = "Registration successful! You can now login.";

            } else {

                $error = "Registration failed.";

            }
        }

        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register | Gym Fitness Hub</title>


<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- ICONS -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link rel="stylesheet" href="css/register.css">

</head>


<body>


<div class="register-container">

<h2><i class="fa-solid fa-user-plus"></i> Create Account</h2>


<?php if($error): ?>

<div class="error-message">

<i class="fa-solid fa-circle-exclamation"></i>

<?php echo $error; ?>

</div>

<?php endif; ?>


<?php if($success): ?>

<div class="success-message">

<i class="fa-solid fa-circle-check"></i>

<?php echo $success; ?>

</div>

<?php endif; ?>



<form method="POST">


<div class="input-group">

<i class="fa-solid fa-user"></i>

<input type="text"

name="username"

placeholder="Enter username"

required>

</div>


<div class="input-group">

<i class="fa-solid fa-lock"></i>

<input type="password"

name="password"

placeholder="Enter password"

required>

</div>



<div class="input-group">

<i class="fa-solid fa-user-tag"></i>

<select name="role" required>

<option value="">Select Role</option>

<option value="admin">Admin</option>

<option value="member">Member</option>

</select>

</div>


<button type="submit"

name="register"

class="btn">

Register

</button>


</form>


<div class="login-link">

Already have account?

<a href="login.php">Login here</a>

</div>


</div>


</body>

</html>
