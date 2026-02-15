<?php
session_start();
include "connect.php"; 

$is_admin = false;
if (isset($_SESSION['user_id'])) {
    $stmt = $conn->prepare("SELECT role FROM tbl_users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if ($user && $user['role'] === 'admin') {
        $is_admin = true;
    }
    $stmt->close();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gym Fitness Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      <nav>
            <div class="logo">
                <a href="landingpage.php">
                <img src="img/logo.jpg" alt="Gym Fitness Hub Logo"></a>
                <span>Gym Fitness Hub - Member</span>
            </div>
        <ul>
          <li><a href="#home">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="logout.php">Logout</a></li>
            <?php if ($is_admin): ?>
              <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
            <?php endif; ?>
          <?php else: ?>
            <li><a href="login.php">Login</a></li>
          <?php endif; ?>
        </ul>
      </nav>
    </header>

    <section id="home" class="hero">
      <div class="hero-content">
        <h1>Transform Your Body, Elevate Your Life</h1>
        <p>
          Join the ultimate fitness community. Workouts, nutrition, and
          motivation all in one place.
        </p>
        <a href="#services" class="btn">Get Started</a>
      </div>
      <div class="hero-image">
      </div>
    </section>

    <section id="about" class="about">
      <h2>About Us</h2>
      <p>
        At Gym Fitness Hub, we're dedicated to helping you achieve your fitness
        goals. From personalized workouts to expert nutrition advice, we've got
        everything you need to stay motivated and strong.
      </p>
    </section>

    <section id="services" class="services">
      <h2>Our Services</h2>
      <div class="service-grid">
        <div class="service-card">
          <h3>Custom Workouts</h3>
          <p>Tailored exercise plans for all levels.</p>
        </div>
        <div class="service-card">
          <h3>Nutrition Guides</h3>
          <p>Meal plans and tips for optimal health.</p>
        </div>
        <div class="service-card">
          <h3>Community Support</h3>
          <p>Connect with like-minded fitness enthusiasts.</p>
        </div>
      </div>
    </section>

    <footer>
      <p>&copy; 2023 Gym Fitness Hub. All rights reserved.</p>
    </footer>

    <script>
      document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
          e.preventDefault();
          document.querySelector(this.getAttribute("href")).scrollIntoView({
            behavior: "smooth",
          });
        });
      });
    </script>
  </body>
</html>