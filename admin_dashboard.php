<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Gym Fitness Hub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="admin-header">
        <nav>
            <div class="logo">Gym Fitness Hub - Admin</div>
            <ul>
                <li><a href="landingpage.php">Back to Site</a></li>
                <li><a href="login.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="admin-container">
        <aside class="sidebar">
            <h3>Menu</h3>
            <ul>
                <li><a href="#overview">Overview</a></li>
                <li><a href="#users">User Management</a></li>
                <li><a href="#workouts">Workout Plans</a></li>
                <li><a href="#reports">Reports</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <section id="overview" class="section">
                <h2>Dashboard Overview</h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Total Users</h3>
                        <p>1,250</p>
                    </div>
                    <div class="stat-card">
                        <h3>Active Workouts</h3>
                        <p>85</p>
                    </div>
                    <div class="stat-card">
                        <h3>Revenue</h3>
                        <p>$12,500</p>
                    </div>
                </div>
            </section>

            <section id="users" class="section">
                <h2>User Management</h2>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Active</td>
                            <td><button class="btn-small">Edit</button> <button class="btn-small">Delete</button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>jane@example.com</td>
                            <td>Inactive</td>
                            <td><button class="btn-small">Edit</button> <button class="btn-small">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <section id="workouts" class="section">
                <h2>Workout Plans</h2>
                <div class="workout-grid">
                    <div class="workout-card">
                        <h3>Beginner Strength</h3>
                        <p>Focus on building core strength.</p>
                        <button class="btn">Edit Plan</button>
                    </div>
                    <div class="workout-card">
                        <h3>Advanced Cardio</h3>
                        <p>High-intensity endurance training.</p>
                        <button class="btn">Edit Plan</button>
                    </div>
                </div>
            </section>

            <section id="reports" class="section">
                <h2>Reports</h2>
                <p>Generate and view analytics here. (Placeholder for charts or downloads.)</p>
                <button class="btn">Download Report</button>
            </section>
        </main>
    </div>

    <script>
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