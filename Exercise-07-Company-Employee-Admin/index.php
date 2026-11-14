<?php
/**
 * IWT Exercise 07: Company Portal Home Page
 */
session_start();
$is_logged_in = isset($_SESSION['user_id']);
$user_role    = $_SESSION['role'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Apex Technologies Enterprise Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="corp-header">
        <div class="nav-container">
            <a href="index.php" class="corp-brand">🏢 Apex <span>Technologies</span></a>
            <nav class="corp-nav">
                <ul>
                    <li><a href="index.php" class="active">Home</a></li>
                    <?php if ($is_logged_in): ?>
                        <?php if ($user_role === 'admin'): ?>
                            <li><a href="admin_dashboard.php" class="role-badge role-admin">Admin Dashboard</a></li>
                        <?php else: ?>
                            <li><a href="employee_dashboard.php" class="role-badge role-employee">Employee Dashboard</a></li>
                        <?php endif; ?>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php" style="background: var(--primary); color: #fff;">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <!-- Hero Section -->
        <div class="card" style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); color: #fff; padding: 45px 35px;">
            <h1 style="font-size: 32px; margin-bottom: 10px;">Enterprise Workforce &amp; Administration Portal</h1>
            <p style="font-size: 16px; color: #dbeafe; max-width: 700px; margin-bottom: 25px;">
                Secure role-based enterprise management system adhering to laboratory specifications for Employees and System Administrators.
            </p>
            <div>
                <?php if ($is_logged_in): ?>
                    <a href="<?php echo ($user_role === 'admin') ? 'admin_dashboard.php' : 'employee_dashboard.php'; ?>" style="background: #ffffff; color: #1e3a8a; padding: 11px 24px; border-radius: 6px; font-weight: 700; text-decoration: none;">Access My Dashboard &rarr;</a>
                <?php else: ?>
                    <a href="login.php" style="background: #ffffff; color: #1e3a8a; padding: 11px 24px; border-radius: 6px; font-weight: 700; text-decoration: none; margin-right: 12px;">Sign In to Portal</a>
                    <a href="register.php" style="border: 2px solid #ffffff; color: #ffffff; padding: 9px 20px; border-radius: 6px; font-weight: 600; text-decoration: none;">New Registration</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Demonstration Rules Card -->
        <div class="card" style="border-left: 5px solid var(--primary);">
            <h2 class="card-title">Laboratory Specification Requirements</h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                <div style="background: #f8fafc; border: 1px solid var(--border); padding: 18px; border-radius: 6px;">
                    <span class="role-badge role-employee" style="margin-bottom: 8px;">Condition 1: Employee Login</span>
                    <p style="font-size: 14px; color: var(--text-muted); margin-top: 6px;">
                        When an <strong>Employee</strong> logs in, the system authenticates their credentials and displays <strong>all Admin details</strong> (Admin Code, Designation, Office Room, Responsibilities, and Emergency Contact).
                    </p>
                </div>
                <div style="background: #f8fafc; border: 1px solid var(--border); padding: 18px; border-radius: 6px;">
                    <span class="role-badge role-admin" style="margin-bottom: 8px;">Condition 2: Admin Login</span>
                    <p style="font-size: 14px; color: var(--text-muted); margin-top: 6px;">
                        When an <strong>Admin</strong> logs in, the system authenticates the admin and displays <strong>all Employee details</strong> (Employee Code, Designation, Department, Salary, Joining Date, and Performance Rating).
                    </p>
                </div>
            </div>
        </div>

        <!-- Pre-Configured Accounts for Demonstration -->
        <div class="card">
            <h3 style="font-size: 17px; margin-bottom: 12px;">Pre-Configured Demonstration Accounts</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>User Name</th>
                        <th>Dashboard Behavior</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="role-badge role-admin">Admin</span></td>
                        <td><code>admin1</code></td>
                        <td><code>admin123</code></td>
                        <td>Dr. Rajeshwari Murthy</td>
                        <td>Displays <strong>All Employee Details</strong></td>
                    </tr>
                    <tr>
                        <td><span class="role-badge role-employee">Employee</span></td>
                        <td><code>emp1</code></td>
                        <td><code>emp123</code></td>
                        <td>Kavita Menon</td>
                        <td>Displays <strong>All Admin Details</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <footer class="corp-footer">
        <p>&copy; 2026 Apex Technologies | IWT Laboratory Exercise 07</p>
    </footer>

</body>
</html>
