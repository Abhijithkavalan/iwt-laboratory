<?php
/**
 * IWT Exercise 06: Student / User Login Page
 */
session_start();
require_once 'db.php';

// Redirect to dashboard if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error_msg = '';
$logout_notice = '';

if (isset($_GET['logout']) && $_GET['logout'] === 'success') {
    $logout_notice = 'You have been successfully logged out of the department portal.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error_msg = 'Please enter both username and password.';
    } else {
        // Authenticate user via prepared statement
        $stmt = $conn->prepare("SELECT id, name, email, phone, username, password FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify hashed password
            if (password_verify($password, $user['password'])) {
                // Initialize session variables
                $_SESSION['user_id']  = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['name']     = $user['name'];
                $_SESSION['email']    = $user['email'];
                $_SESSION['phone']    = $user['phone'];

                $stmt->close();
                header('Location: dashboard.php');
                exit;
            } else {
                $error_msg = 'Incorrect password. Please try again.';
            }
        } else {
            $error_msg = 'No account found with this username or email.';
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
    <title>Portal Login | Department of Computer Applications</title>
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
                    <li><a href="login.php" class="active">Login</a></li>
                    <li><a href="register.php" class="btn-nav-action">Register</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="auth-wrapper">
            <div class="card">
                <div class="auth-header">
                    <h2>Department Portal Login</h2>
                    <p>Enter your credentials to access your dashboard</p>
                </div>

                <!-- Demonstration Hint for Lab Examiner -->
                <div style="background: #e0f2fe; border-left: 4px solid var(--primary); padding: 10px 14px; border-radius: 4px; font-size: 13px; margin-bottom: 20px; color: #0369a1;">
                    <strong>Demo Credentials:</strong><br>
                    Username: <code>student1</code> | Password: <code>password123</code>
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
                        <label for="username">Username or Email *</label>
                        <input type="text" id="username" name="username" placeholder="Enter username or email" value="<?php echo htmlspecialchars($username ?? ''); ?>" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>

                    <button type="submit" class="btn-block">Sign In &rarr;</button>
                </form>

                <p style="text-align: center; margin-top: 20px; font-size: 14px; color: var(--text-muted);">
                    Don't have an account yet? <a href="register.php" style="color: var(--primary); font-weight: 600;">Register here</a>
                </p>
            </div>
        </div>
    </main>

    <footer class="dept-footer">
        <p>&copy; 2026 Department of Computer Science &amp; Applications | IWT Laboratory Exercise 06</p>
    </footer>

</body>
</html>
