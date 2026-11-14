<?php
/**
 * IWT Exercise 07: Employee Dashboard
 * Condition 1: If employee logs in, authenticate the employee and display all admin details.
 */
session_start();

// Authentication Guard
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Role Enforcement: If Admin visits employee dashboard, redirect to admin dashboard
if ($_SESSION['role'] !== 'employee') {
    header('Location: admin_dashboard.php');
    exit;
}

require_once 'db.php';

$user_id = $_SESSION['user_id'];

// Fetch current employee's personal profile
$emp_stmt = $conn->prepare("
    SELECT u.name, u.email, u.phone, u.username, e.emp_code, e.department, e.designation, e.salary, e.joining_date, e.performance_rating
    FROM users u
    JOIN employee_profiles e ON u.id = e.user_id
    WHERE u.id = ?
");
$emp_stmt->bind_param("i", $user_id);
$emp_stmt->execute();
$current_emp = $emp_stmt->get_result()->fetch_assoc();
$emp_stmt->close();

// Fetch ALL Admin Details as required by Exercise 07 Condition 1
$admins_query = "
    SELECT u.name, u.email, u.phone, a.admin_code, a.office_room, a.department, a.designation, a.responsibilities, a.emergency_contact
    FROM admin_profiles a
    JOIN users u ON a.user_id = u.id
    ORDER BY a.id ASC
";
$admins_result = $conn->query($admins_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Portal | Apex Technologies</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="corp-header">
        <div class="nav-container">
            <a href="index.php" class="corp-brand">🏢 Apex <span>Technologies</span></a>
            <nav class="corp-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="employee_dashboard.php" class="active">Employee Dashboard</a></li>
                    <li><a href="logout.php" style="background: #dc2626; color: #fff;">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        
        <!-- Welcome Banner -->
        <div class="card" style="border-left: 5px solid var(--emp-theme); background: #f0fdf4;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                <div>
                    <span class="role-badge role-employee">&#9679; Authenticated Employee Session</span>
                    <h2 style="margin-top: 6px;">Welcome, <?php echo htmlspecialchars($current_emp['name'] ?? $_SESSION['name']); ?>!</h2>
                    <p style="color: var(--text-muted); font-size: 14px;">
                        Employee Code: <strong><?php echo htmlspecialchars($current_emp['emp_code'] ?? 'EMP-NEW'); ?></strong> | 
                        Designation: <strong><?php echo htmlspecialchars($current_emp['designation'] ?? 'Staff Member'); ?></strong>
                    </p>
                </div>
                <div>
                    <a href="logout.php" style="background: #dc2626; color: #ffffff; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600;">Sign Out &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Exercise 07 Condition 1 Display Section -->
        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 15px;">
                <div>
                    <h3 class="card-title" style="color: var(--admin-dark);">Executive Administrator Directory</h3>
                    <p class="card-subtitle" style="margin-bottom: 0;">
                        <strong>Laboratory Condition 1 Fulfilled:</strong> As an authenticated Employee, here is the complete roster of all company Administrators.
                    </p>
                </div>
                <div>
                    <span class="role-badge role-admin">Total Admins: <?php echo $admins_result ? $admins_result->num_rows : 0; ?></span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Admin Code</th>
                            <th>Administrator Name</th>
                            <th>Corporate Email</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Office Location</th>
                            <th>Key Responsibilities</th>
                            <th>Emergency Desk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($admin = $admins_result->fetch_assoc()): ?>
                            <tr>
                                <td><span class="role-badge role-admin"><?php echo htmlspecialchars($admin['admin_code']); ?></span></td>
                                <td><strong><?php echo htmlspecialchars($admin['name']); ?></strong></td>
                                <td><a href="mailto:<?php echo htmlspecialchars($admin['email']); ?>" style="color: var(--primary); text-decoration: none;"><?php echo htmlspecialchars($admin['email']); ?></a></td>
                                <td><?php echo htmlspecialchars($admin['department']); ?></td>
                                <td><?php echo htmlspecialchars($admin['designation']); ?></td>
                                <td>📍 <?php echo htmlspecialchars($admin['office_room']); ?></td>
                                <td style="max-width: 250px; font-size: 13px;"><?php echo htmlspecialchars($admin['responsibilities']); ?></td>
                                <td>📞 <?php echo htmlspecialchars($admin['emergency_contact']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Security Role Enforcement Test Notice -->
        <div class="card" style="background: #f8fafc; border-left: 4px solid #f59e0b;">
            <h4 style="color: #b45309; margin-bottom: 6px;">Access Control Test Note</h4>
            <p style="font-size: 13.5px; color: var(--text-muted);">
                Role restriction is enforced on server-side. As an employee, attempting to visit <code>admin_dashboard.php</code> directly in the browser address bar will automatically be denied or redirected.
            </p>
        </div>

    </main>

    <footer class="corp-footer">
        <p>&copy; 2026 Apex Technologies | IWT Laboratory Exercise 07</p>
    </footer>

</body>
</html>
