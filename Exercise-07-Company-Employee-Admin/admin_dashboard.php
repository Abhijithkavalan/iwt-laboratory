<?php
/**
 * IWT Exercise 07: Admin Dashboard
 * Condition 2: If admin logs in, authenticate the admin and display all employee details.
 */
session_start();

// Authentication Guard
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Strict Role Enforcement: Prevent unauthorized Employee access to Admin Dashboard
if ($_SESSION['role'] !== 'admin') {
    header('Location: employee_dashboard.php?error=unauthorized');
    exit;
}

require_once 'db.php';

$user_id = $_SESSION['user_id'];

// Fetch current administrator's personal profile
$adm_stmt = $conn->prepare("
    SELECT u.name, u.email, u.phone, u.username, a.admin_code, a.office_room, a.department, a.designation, a.responsibilities, a.emergency_contact
    FROM users u
    JOIN admin_profiles a ON u.id = a.user_id
    WHERE u.id = ?
");
$adm_stmt->bind_param("i", $user_id);
$adm_stmt->execute();
$current_admin = $adm_stmt->get_result()->fetch_assoc();
$adm_stmt->close();

// Fetch ALL Employee Details as required by Exercise 07 Condition 2
$employees_query = "
    SELECT u.name, u.email, u.phone, e.emp_code, e.department, e.designation, e.salary, e.joining_date, e.performance_rating
    FROM employee_profiles e
    JOIN users u ON e.user_id = u.id
    ORDER BY e.id ASC
";
$employees_result = $conn->query($employees_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Apex Technologies</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="corp-header">
        <div class="nav-container">
            <a href="index.php" class="corp-brand">🏢 Apex <span>Technologies</span></a>
            <nav class="corp-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="admin_dashboard.php" class="active">Admin Dashboard</a></li>
                    <li><a href="logout.php" style="background: #dc2626; color: #fff;">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        
        <!-- Welcome Banner -->
        <div class="card" style="border-left: 5px solid var(--admin-theme); background: #faf5ff;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                <div>
                    <span class="role-badge role-admin">&#9679; Authenticated System Administrator</span>
                    <h2 style="margin-top: 6px;">Welcome, <?php echo htmlspecialchars($current_admin['name'] ?? $_SESSION['name']); ?>!</h2>
                    <p style="color: var(--text-muted); font-size: 14px;">
                        Admin ID: <strong><?php echo htmlspecialchars($current_admin['admin_code'] ?? 'ADM-NEW'); ?></strong> | 
                        Designation: <strong><?php echo htmlspecialchars($current_admin['designation'] ?? 'Executive Officer'); ?></strong> | 
                        Office: <strong><?php echo htmlspecialchars($current_admin['office_room'] ?? 'Admin Block'); ?></strong>
                    </p>
                </div>
                <div>
                    <a href="logout.php" style="background: #dc2626; color: #ffffff; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600;">Sign Out &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Exercise 07 Condition 2 Display Section -->
        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 15px;">
                <div>
                    <h3 class="card-title" style="color: var(--emp-theme);">Workforce Employee Records</h3>
                    <p class="card-subtitle" style="margin-bottom: 0;">
                        <strong>Laboratory Condition 2 Fulfilled:</strong> As an authenticated Administrator, here is the complete roster of all company Employees.
                    </p>
                </div>
                <div>
                    <span class="role-badge role-employee">Total Employees: <?php echo $employees_result ? $employees_result->num_rows : 0; ?></span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Emp Code</th>
                            <th>Employee Name</th>
                            <th>Email Address</th>
                            <th>Contact Phone</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Monthly Salary</th>
                            <th>Joining Date</th>
                            <th>Performance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($emp = $employees_result->fetch_assoc()): ?>
                            <tr>
                                <td><span class="role-badge role-employee"><?php echo htmlspecialchars($emp['emp_code']); ?></span></td>
                                <td><strong><?php echo htmlspecialchars($emp['name']); ?></strong></td>
                                <td><a href="mailto:<?php echo htmlspecialchars($emp['email']); ?>" style="color: var(--primary); text-decoration: none;"><?php echo htmlspecialchars($emp['email']); ?></a></td>
                                <td><?php echo htmlspecialchars($emp['phone']); ?></td>
                                <td><span style="background: #f1f5f9; padding: 3px 8px; border-radius: 4px; font-weight: 600; font-size: 12px;"><?php echo htmlspecialchars($emp['department']); ?></span></td>
                                <td><?php echo htmlspecialchars($emp['designation']); ?></td>
                                <td style="font-weight: 700; color: #047857;">&#8377;<?php echo number_format($emp['salary'], 2); ?></td>
                                <td><?php echo htmlspecialchars(date('d M Y', strtotime($emp['joining_date']))); ?></td>
                                <td><span style="font-weight: 700; color: #b45309;">&#9733; <?php echo htmlspecialchars($emp['performance_rating']); ?></span></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <footer class="corp-footer">
        <p>&copy; 2026 Apex Technologies | IWT Laboratory Exercise 07</p>
    </footer>

</body>
</html>
