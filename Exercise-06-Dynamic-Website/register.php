<?php
/**
 * IWT Exercise 06: Student / User Registration Page
 */
session_start();
require_once 'db.php';

$success_msg = '';
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validation
    if (empty($name) || empty($email) || empty($phone) || empty($username) || empty($password)) {
        $error_msg = 'All registration fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = 'Please enter a valid academic/personal email address.';
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $error_msg = 'Phone number must be exactly 10 digits.';
    } elseif (strlen($password) < 6) {
        $error_msg = 'Password must be at least 6 characters long.';
    } else {
        // Check for duplicate username or email
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $check_stmt->bind_param("ss", $username, $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $error_msg = 'An account with this Username or Email address already exists.';
            $check_stmt->close();
        } else {
            $check_stmt->close();

            // Hash password securely using PHP standard bcrypt
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user record
            $insert_stmt = $conn->prepare("INSERT INTO users (name, email, phone, username, password) VALUES (?, ?, ?, ?, ?)");
            $insert_stmt->bind_param("sssss", $name, $email, $phone, $username, $hashed_password);

            if ($insert_stmt->execute()) {
                $success_msg = "Account created successfully for '{$username}'! You can now proceed to login.";
                $name = $email = $phone = $username = '';
            } else {
                $error_msg = "Registration failed: " . htmlspecialchars($insert_stmt->error);
            }
            $insert_stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration | Department Portal</title>
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
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php" class="active">Register</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="auth-wrapper">
            <div class="card">
                <div class="auth-header">
                    <h2>Student Registration</h2>
                    <p>Create your department portal account</p>
                </div>

                <?php if (!empty($success_msg)): ?>
                    <div class="alert alert-success">
                        <span>&#10004;</span>
                        <div>
                            <?php echo htmlspecialchars($success_msg); ?><br>
                            <a href="login.php" style="color: #14532d; font-weight: 700; text-decoration: underline;">Click here to Login &rarr;</a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($error_msg)): ?>
                    <div class="alert alert-danger">
                        <span>&#9888;</span>
                        <div><?php echo htmlspecialchars($error_msg); ?></div>
                    </div>
                <?php endif; ?>

                <form action="register.php" method="POST" id="registerForm">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" placeholder="e.g. Rahul Sharma" value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" placeholder="e.g. rahul.sharma@dept.edu" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" placeholder="10-digit mobile number" value="<?php echo htmlspecialchars($phone ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="username">Choose Username *</label>
                        <input type="text" id="username" name="username" placeholder="e.g. rahul_s" value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Choose Password *</label>
                        <input type="password" id="password" name="password" placeholder="Minimum 6 characters" required>
                    </div>

                    <button type="submit" class="btn-block">&#10004; Register Account</button>
                </form>

                <p style="text-align: center; margin-top: 20px; font-size: 14px; color: var(--text-muted);">
                    Already registered? <a href="login.php" style="color: var(--primary); font-weight: 600;">Sign in to your account</a>
                </p>
            </div>
        </div>
    </main>

    <footer class="dept-footer">
        <p>&copy; 2026 Department of Computer Science &amp; Applications | IWT Laboratory Exercise 06</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
