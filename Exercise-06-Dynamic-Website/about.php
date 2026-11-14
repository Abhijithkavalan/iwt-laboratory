<?php
/**
 * IWT Exercise 06: About Us Page
 */
session_start();
$is_logged_in = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Department of Computer Applications</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Header & Navigation -->
    <header class="dept-header">
        <div class="nav-container">
            <a href="index.php" class="dept-brand">
                🎓 <span>CS &amp; MCA</span> Department
            </a>
            <nav class="dept-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php" class="active">About Us</a></li>
                    <?php if ($is_logged_in): ?>
                        <li><a href="dashboard.php" class="btn-nav-action">Dashboard (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php" class="btn-nav-action">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="card" style="margin-bottom: 25px;">
            <h2>About the Department</h2>
            <p style="margin-top: 10px; font-size: 15px; color: var(--text-muted);">
                Established with a mission to impart world-class computer science education, our Department has consistently produced industry-ready professionals, software developers, and research scholars.
            </p>
        </div>

        <div class="grid-3">
            <div class="card">
                <h3>Our Vision</h3>
                <p>To be recognized as a premier center of technical excellence in Computer Applications education, fostering innovation, scientific temper, and ethical leadership.</p>
            </div>
            <div class="card">
                <h3>Our Mission</h3>
                <p>To deliver quality academic programs, facilitate hands-on laboratory experiences in full-stack web engineering, and cultivate strong problem-solving capabilities.</p>
            </div>
            <div class="card">
                <h3>Core Values</h3>
                <p>Academic Integrity, Research Rigor, Collaborative Spirit, Technological Relevance, and Lifelong Learning.</p>
            </div>
        </div>

        <div class="card">
            <h3>Department Faculty Members</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-top: 15px;">
                <div style="background: #f8fafc; padding: 15px; border-radius: 6px; border-left: 4px solid var(--primary);">
                    <h4 style="color: var(--secondary);">Dr. K. S. Ramanathan</h4>
                    <span style="font-size: 13px; color: var(--primary); font-weight: 600;">Professor &amp; Head of Department</span>
                    <p style="font-size: 13px; color: var(--text-muted); margin-top: 5px;">Specialization: Distributed Systems &amp; Web Architectures</p>
                </div>
                <div style="background: #f8fafc; padding: 15px; border-radius: 6px; border-left: 4px solid var(--primary);">
                    <h4 style="color: var(--secondary);">Prof. Meenakshi Sundaram</h4>
                    <span style="font-size: 13px; color: var(--primary); font-weight: 600;">Associate Professor</span>
                    <p style="font-size: 13px; color: var(--text-muted); margin-top: 5px;">Specialization: Database Management &amp; Information Security</p>
                </div>
                <div style="background: #f8fafc; padding: 15px; border-radius: 6px; border-left: 4px solid var(--primary);">
                    <h4 style="color: var(--secondary);">Dr. Arvind Swaminathan</h4>
                    <span style="font-size: 13px; color: var(--primary); font-weight: 600;">Assistant Professor</span>
                    <p style="font-size: 13px; color: var(--text-muted); margin-top: 5px;">Specialization: Web Technologies, PHP &amp; Cloud Infrastructure</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="dept-footer">
        <p>&copy; 2026 Department of Computer Science &amp; Applications | IWT Laboratory Exercise 06</p>
    </footer>

</body>
</html>
