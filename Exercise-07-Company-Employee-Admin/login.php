<?php
/**
 * IWT Exercise 07: Role-Based Login Handler
 */
session_start();
require_once 'db.php';

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header('Location: admin_dashboard.php');
        exit;
    } else {
        header('Location: employee_dashboard.php');
        exit;
    }
}

$error_msg = '';
$logout_notice = '';

if (isset($_GET['logout']) && $_GET['logout'] === 'success') {
    $logout_notice = 'You have been successfully signed out.';
}

if (isset($_GET['error']) && $_GET['error'] === 'unauthorized') {
    $error_msg = 'Access Denied: You do not possess the required permissions to access that dashboard.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error_msg = 'Please enter both username and password.';
    } else {
        $stmt = $conn->prepare("SELECT id, username, password, role, name, email, phone FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                // Set session
                $_SESSION['user_id']  = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['name']     = $user['name'];
                $_SESSION['email']    = $user['email'];
                $_SESSION['phone']    = $user['phone'];
                $_SESSION['role']     = $user['role'];

                $stmt->close();

                // Role-based redirection according to exercise specification
                if ($user['role'] === 'admin') {
                    header('Location: admin_dashboard.php');
                } else {
                    header('Location: employee_dashboard.php');
                }
                exit;
            } else {
                $error_msg = 'Invalid password credentials. Please verify and try again.';
            }
        } else {
            $error_msg = 'No user account found matching this username or email.';
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
    <title>Corporate Login | Apex Technologies</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="corp-header">
        <div class="nav-container">
            <a href="index.php" class="corp-brand">🏢 Apex <span>Technologies</span></a>
            <nav class="corp-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="login.php" class="active">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="auth-box">
            <div class="card">
                <h2 class="card-title" style="text-align: center;">Sign In to Portal</h2>
                <p class="card-subtitle" style="text-align: center;">Role-based authentication gateway</p>

                <!-- Demonstration Box for Exam Evaluation -->
                <div style="background: #f1f5f9; border: 1px solid var(--border); padding: 12px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 20px;">
                    <strong style="color: var(--secondary);">Demo Lab Credentials:</strong>
                    <div style="margin-top: 6px; display: flex; justify-content: space-between;">
                        <div>
                            <span class="role-badge role-admin">Admin</span><br>
                            <code>admin1</code> / <code>admin123</code>
                        </div>
                        <div>
                            <span class="role-badge role-employee">Employee</span><br>
                            <code>emp1</code> / <code>emp123</code>
                        </div>
                    </div>
                </div>

                <?php if (!empty($logout_notice)): ?>
                    <div class="alert alert-success">
                        <span>&#10004;</span>
                        <div><?php echo htmlspecialchars($logout_notice); ?></div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($error_msg)): ?>
                    <div class="alert alert-danger">
                        <span>&#9888;</span>
                        <div><?php echo htmlspecialchars($error_msg); ?></div>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username or Corporate Email *</label>
                        <input type="text" id="username" name="username" placeholder="e.g. admin1 or emp1" value="<?php echo htmlspecialchars($username ?? ''); ?>" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" placeholder="Enter password" required>
                    </div>

                    <button type="submit" class="btn-primary">Authenticate &rarr;</button>
                </form>

                <p style="text-align: center; margin-top: 15px; font-size: 14px; color: var(--text-muted);">
                    Need an account? <a href="register.php" style="color: var(--primary); font-weight: 600;">Register new role</a>
                </p>
            </div>
        </div>
    </main>

    <footer class="corp-footer">
        <p>&copy; 2026 Apex Technologies | IWT Laboratory Exercise 07</p>
    </footer>

</body>
</html>
