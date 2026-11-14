<?php
/**
 * IWT Exercise 06: Protected User Dashboard
 */
session_start();

// Access Control: Redirect unauthenticated visitors to login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'db.php';

// Fetch fresh details from database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, phone, username, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | Department Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="dept-header">
        <div class="nav-container">
            <a href="index.php" class="dept-brand">🎓 <span>CS &amp; MCA</span> Department</a>
            <nav class="dept-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="dashboard.php" class="active">Dashboard</a></li>
                    <li><a href="logout.php" style="background: #dc2626; color: #fff;">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        
        <!-- Welcome Card -->
        <div class="card" style="margin-bottom: 25px; border-left: 5px solid var(--primary);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                <div>
                    <span class="user-badge">&#9679; Authenticated Session</span>
                    <h2>Welcome back, <?php echo htmlspecialchars($user['name']); ?>!</h2>
                    <p style="color: var(--text-muted); font-size: 14.5px;">You are securely authenticated using PHP Sessions and MySQL.</p>
                </div>
                <div>
                    <a href="logout.php" style="background: #dc2626; color: #ffffff; padding: 9px 18px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px;">Sign Out &rarr;</a>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
            
            <!-- User Profile Details Card -->
            <div class="card">
                <h3>My Department Profile</h3>
                <table class="profile-table">
                    <tr>
                        <th>Full Name:</th>
                        <td><strong><?php echo htmlspecialchars($user['name']); ?></strong></td>
                    </tr>
                    <tr>
                        <th>Username:</th>
                        <td><code><?php echo htmlspecialchars($user['username']); ?></code></td>
                    </tr>
                    <tr>
                        <th>Registered Email:</th>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                    </tr>
                    <tr>
                        <th>Phone Number:</th>
                        <td><?php echo htmlspecialchars($user['phone']); ?></td>
                    </tr>
                    <tr>
                        <th>Registration Date:</th>
                        <td><?php echo htmlspecialchars(date('d M Y, h:i A', strtotime($user['created_at']))); ?></td>
                    </tr>
                    <tr>
                        <th>Account Status:</th>
                        <td><span style="color: var(--success); font-weight: 700;">Active Scholar</span></td>
                    </tr>
                </table>
            </div>

            <!-- Department Laboratory Modules -->
            <div class="card">
                <h3>Registered Lab Courses</h3>
                <ul style="list-style: none; margin-top: 15px;">
                    <li style="background: #f8fafc; padding: 12px 14px; border-radius: 6px; margin-bottom: 10px; border-left: 3px solid var(--primary);">
                        <strong style="color: var(--secondary);">MCA-204: Internet &amp; Web Technologies Lab</strong><br>
                        <span style="font-size: 13px; color: var(--text-muted);">HTML5, CSS3, JavaScript, PHP, MySQL, AJAX</span>
                    </li>
                    <li style="background: #f8fafc; padding: 12px 14px; border-radius: 6px; margin-bottom: 10px; border-left: 3px solid var(--primary);">
                        <strong style="color: var(--secondary);">MCA-205: Advanced Database Systems Lab</strong><br>
                        <span style="font-size: 13px; color: var(--text-muted);">Relational Schemas, Indexing, Transactions</span>
                    </li>
                    <li style="background: #f8fafc; padding: 12px 14px; border-radius: 6px; border-left: 3px solid var(--primary);">
                        <strong style="color: var(--secondary);">MCA-206: Software Engineering Practices</strong><br>
                        <span style="font-size: 13px; color: var(--text-muted);">Agile Methodologies, Architecture &amp; Testing</span>
                    </li>
                </ul>
            </div>

        </div>

    </main>

    <footer class="dept-footer">
        <p>&copy; 2026 Department of Computer Science &amp; Applications | IWT Laboratory Exercise 06</p>
    </footer>

</body>
</html>
