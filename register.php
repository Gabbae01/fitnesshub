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

<link rel="stylesheet" href="style.css">


<style>

/* PAGE BACKGROUND */

body{

font-family: 'Poppins', sans-serif;

background: linear-gradient(135deg,#4caf50,#1b5e20);

height:100vh;

display:flex;

justify-content:center;

align-items:center;

margin:0;

}


/* CARD */

.register-container{

background:white;

padding:40px;

border-radius:15px;

width:400px;

box-shadow:0 20px 40px rgba(0,0,0,0.2);

animation:fadeIn 0.5s ease;

}


/* TITLE */

.register-container h2{

text-align:center;

margin-bottom:25px;

color:#2e7d32;

}


/* INPUT GROUP */

.input-group{

position:relative;

margin-bottom:20px;

}


.input-group i{

position:absolute;

top:14px;

left:12px;

color:#4caf50;

}


.input-group input,
.input-group select{

width:100%;

padding:12px 12px 12px 40px;

border-radius:8px;

border:1px solid #ccc;

font-size:15px;

}


/* BUTTON */

.btn{

width:100%;

padding:12px;

background:linear-gradient(45deg,#4caf50,#2e7d32);

color:white;

border:none;

border-radius:8px;

font-weight:600;

cursor:pointer;

transition:0.3s;

}


.btn:hover{

transform:translateY(-2px);

box-shadow:0 10px 20px rgba(0,0,0,0.2);

}


/* MESSAGE */

.error-message{

background:#ffebee;

color:#c62828;

padding:10px;

border-radius:8px;

margin-bottom:15px;

text-align:center;

}


.success-message{

background:#e8f5e9;

color:#2e7d32;

padding:10px;

border-radius:8px;

margin-bottom:15px;

text-align:center;

}


/* LOGIN LINK */

.login-link{

text-align:center;

margin-top:15px;

}


.login-link a{

color:#2e7d32;

font-weight:600;

text-decoration:none;

}


.login-link a:hover{

text-decoration:underline;

}


/* ANIMATION */

@keyframes fadeIn{

from{

opacity:0;

transform:translateY(-20px);

}

to{

opacity:1;

transform:translateY(0);

}

}

</style>

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
