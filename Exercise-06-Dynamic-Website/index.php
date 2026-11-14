<?php
/**
 * IWT Exercise 06: Department Home Page
 */
session_start();
$is_logged_in = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Department of Computer Science &amp; Applications</title>
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
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
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

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero">
            <h1>Welcome to the Department of Computer Applications</h1>
            <p>Empowering scholars with cutting-edge knowledge in Internet &amp; Web Technologies, Artificial Intelligence, Cloud Computing, and Software Engineering.</p>
            <div class="hero-actions">
                <?php if ($is_logged_in): ?>
                    <a href="dashboard.php" style="background: #ffffff; color: #0284c7; padding: 10px 22px; border-radius: 6px; font-weight: 700; text-decoration: none;">Go to Student Dashboard &rarr;</a>
                <?php else: ?>
                    <a href="register.php" style="background: #ffffff; color: #0284c7; padding: 10px 22px; border-radius: 6px; font-weight: 700; text-decoration: none;">Join Department Portal</a>
                    <a href="login.php" style="border: 2px solid #ffffff; color: #ffffff; padding: 8px 20px; border-radius: 6px; font-weight: 600; text-decoration: none;">Student Login</a>
                <?php endif; ?>
            </div>
        </section>

        <!-- Department Highlights Grid -->
        <section class="grid-3">
            <div class="card">
                <h3>Academic Programs</h3>
                <p>Offering flagship programs including Master of Computer Applications (MCA) and M.Sc. in Computer Science with industry-aligned lab curricula.</p>
            </div>
            <div class="card">
                <h3>State-of-the-Art Labs</h3>
                <p>Fully equipped computing laboratories running Linux, Apache, MySQL, PHP, and high-performance computing clusters for practical training.</p>
            </div>
            <div class="card">
                <h3>Research &amp; Innovation</h3>
                <p>Active research cells focusing on Web 3.0, Distributed Systems, Data Science, Cyber Security, and Software Verification.</p>
            </div>
        </section>

        <!-- Department Notice Board -->
        <div class="card">
            <h3>Department Announcements &amp; Notice Board</h3>
            <ul style="margin: 15px 0 0 20px; color: var(--text-muted); font-size: 14.5px;">
                <li style="margin-bottom: 8px;"><strong>IWT Lab Exam:</strong> Internet &amp; Web Technologies practical examinations scheduled for current semester scholars.</li>
                <li style="margin-bottom: 8px;"><strong>Technical Symposium:</strong> Annual collegiate coding contest "ByteCraft 2026" registrations now open via portal.</li>
                <li><strong>Guest Lecture:</strong> National seminar on Cloud Native Architectures and Modern Microservices on Friday at 10:00 AM.</li>
            </ul>
        </div>
    </main>

    <!-- Footer -->
    <footer class="dept-footer">
        <p>&copy; 2026 Department of Computer Science &amp; Applications | IWT Laboratory Exercise 06</p>
    </footer>

</body>
</html>
