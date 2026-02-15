<?php
session_start();
include "connect.php"; // Include your DB connection

// Check if logged in and is a member
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect if not logged in
    exit;
}
$stmt = $conn->prepare("SELECT role FROM tbl_users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if (!$user || $user['role'] !== 'member') {
    header('Location: landingpage.php'); // Redirect if not a member
    exit;
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard - Gym Fitness Hub</title>
    <link rel="stylesheet" href="style.css"> <!-- Links to your shared styles.css -->
</head>
<body>
    <header class="member-header">
        <nav>
            <div class="logo">
                <a href="landingpage.php">
                <img src="img/logo.jpg" alt="Gym Fitness Hub Logo"></a>
                <span>Gym Fitness Hub - Member</span>
            </div>
            <ul>
                <li><a href="landingpage.php">Back to Site</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="member-container">
        <aside class="sidebar">
            <h3>Menu</h3>
            <ul>
                <li><a href="#overview">Overview</a></li>
                <li><a href="#workouts">My Workouts</a></li>
                <li><a href="#nutrition">Nutrition Plan</a></li>
                <li><a href="#progress">Progress Tracker</a></li>
                <li><a href="#profile">Profile Settings</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <section id="overview" class="section">
                <br>
                <h2>Welcome Back!</h2>
                <p>Track your fitness journey, view your plans, and stay motivated.</p>
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Workouts Completed</h3>
                        <p>15</p>
                    </div>
                    <div class="stat-card">
                        <h3>Calories Burned</h3>
                        <p>2,500</p>
                    </div>
                    <div class="stat-card">
                        <h3>Goals Achieved</h3>
                        <p>3</p>
                    </div>
                </div>
            </section>

            <section id="workouts" class="section">
                <h2>My Workouts</h2>
                <div class="workout-grid">
                    <div class="workout-card">
                        <h3>Upper Body Strength</h3>
                        <p>Push-ups, pull-ups, and shoulder presses. 45 mins.</p>
                        <button class="btn">Start Workout</button>
                    </div>
                    <div class="workout-card">
                        <h3>Cardio Blast</h3>
                        <p>Running intervals and HIIT. 30 mins.</p>
                        <button class="btn">Start Workout</button>
                    </div>
                    <div class="workout-card">
                        <h3>Core Focus</h3>
                        <p>Planks, crunches, and leg raises. 20 mins.</p>
                        <button class="btn">Start Workout</button>
                    </div>
                </div>
            </section>

            <section id="nutrition" class="section">
                <h2>Nutrition Plan</h2>
                <p>Your personalized meal plan for the week.</p>
                <ul class="nutrition-list">
                    <li><strong>Monday:</strong> Oatmeal, grilled chicken salad, quinoa bowl.</li>
                    <li><strong>Tuesday:</strong> Smoothie, turkey wrap, sweet potato.</li>
                    <li><strong>Wednesday:</strong> Eggs, salmon, veggies.</li>
                    <!-- Add more days as needed -->
                </ul>
                <button class="btn">Update Plan</button>
            </section>

            <section id="progress" class="section">
                <h2>Progress Tracker</h2>
                <p>Monitor your gains over time.</p>
                <div class="progress-item">
                    <label>Weight Loss Goal: 10 lbs</label>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 60%;"></div>
                    </div>
                    <span>6 lbs lost</span>
                </div>
                <div class="progress-item">
                    <label>Muscle Gain: 5 lbs</label>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 40%;"></div>
                    </div>
                    <span>2 lbs gained</span>
                </div>
            </section>

            <section id="profile" class="section">
                <h2>Profile Settings</h2>
                <form class="profile-form">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="John Doe" required>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="john@example.com" required>
                    
                    <label for="goal">Fitness Goal:</label>
                    <select id="goal" name="goal">
                        <option value="weight-loss">Weight Loss</option>
                        <option value="muscle-gain">Muscle Gain</option>
                        <option value="endurance">Endurance</option>
                    </select>
                    
                    <button type="submit" class="btn">Save Changes</button>
                </form>
            </section>
        </main>
    </div>

    <script>
        // Smooth scroll for sidebar links
        document.querySelectorAll('.sidebar a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>