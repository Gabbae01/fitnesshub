<?php
session_start();
include "connect.php";

$error = "";

if (isset($_POST["login"])) {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {

        $error = "Username and password are required.";

    } else {

        $stmt = $conn->prepare("SELECT id, password, role FROM tbl_users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 1) {

            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {

                session_regenerate_id(true);

                $_SESSION['user_id'] = $row['id'];
                $_SESSION['role'] = $row['role'];

                if ($row['role'] == "admin") {

                    header("Location: admin_dashboard.php");
                    exit();

                } else {

                    header("Location: member_dashboard.php");
                    exit();

                }

            } else {

                $error = "Invalid username or password.";

            }

        } else {

            $error = "Invalid username or password.";

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

<title>Login | Gym Fitness Hub</title>


<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


<!-- FONT AWESOME ICONS -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link rel="stylesheet" href="css/login.css">

<!-- <style>

/* BACKGROUND */

body{

font-family:'Poppins',sans-serif;

background:linear-gradient(135deg,#4caf50,#1b5e20);

height:100vh;

display:flex;

justify-content:center;

align-items:center;

margin:0;

}


/* LOGIN CARD */

.login-container{

background:white;

padding:40px;

width:400px;

border-radius:15px;

box-shadow:0 20px 40px rgba(0,0,0,0.2);

animation:fadeIn 0.5s ease;

}


/* TITLE */

.login-container h2{

text-align:center;

color:#2e7d32;

margin-bottom:25px;

}


/* INPUT GROUP */

.input-group{

position:relative;

margin-bottom:20px;

}


.input-group i{

position:absolute;

left:12px;

top:14px;

color:#4caf50;

}


.input-group input{

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


/* ERROR MESSAGE */

.error-message{

background:#ffebee;

color:#c62828;

padding:10px;

border-radius:8px;

margin-bottom:15px;

text-align:center;

}


/* LINK */

.register-link{

text-align:center;

margin-top:15px;

}


.register-link a{

color:#2e7d32;

font-weight:600;

text-decoration:none;

}


.register-link a:hover{

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

</style> -->

</head>


<body>


<div class="login-container">

<h2><i class="fa-solid fa-right-to-bracket"></i> Login</h2>


<?php if(!empty($error)): ?>

<div class="error-message">

<i class="fa-solid fa-circle-exclamation"></i>

<?php echo htmlspecialchars($error); ?>

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


<button type="submit"

name="login"

class="btn">

Login

</button>


</form>


<div class="register-link">

Don't have an account?

<a href="register.php">Register here</a>

</div>


</div>


</body>
</html>
