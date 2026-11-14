<?php
/**
 * IWT Exercise 07: User & Employee/Admin Registration
 */
session_start();
require_once 'db.php';

$success_msg = '';
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = trim($_POST['name'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $phone       = trim($_POST['phone'] ?? '');
    $username    = trim($_POST['username'] ?? '');
    $password    = $_POST['password'] ?? '';
    $role        = trim($_POST['role'] ?? 'employee');
    $department  = trim($_POST['department'] ?? '');
    $designation = trim($_POST['designation'] ?? '');

    if (empty($name) || empty($email) || empty($phone) || empty($username) || empty($password) || empty($department) || empty($designation)) {
        $error_msg = 'All registration fields are mandatory.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = 'Please enter a valid email address.';
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
            $error_msg = 'An account with this username or email already exists.';
            $check_stmt->close();
        } else {
            $check_stmt->close();

            $hashed = password_hash($password, PASSWORD_DEFAULT);

            // Begin transaction
            $conn->begin_transaction();
            try {
                $user_stmt = $conn->prepare("INSERT INTO users (username, password, role, name, email, phone) VALUES (?, ?, ?, ?, ?, ?)");
                $user_stmt->bind_param("ssssss", $username, $hashed, $role, $name, $email, $phone);
                $user_stmt->execute();
                $new_user_id = $conn->insert_id;
                $user_stmt->close();

                if ($role === 'admin') {
                    $admin_code = 'ADM-' . str_pad($new_user_id, 3, '0', STR_PAD_LEFT);
                    $office_room = 'Admin Suite ' . (300 + $new_user_id);
                    $responsibilities = 'Departmental management, executive reporting, and supervisory oversight.';
                    $emergency = '080-234500' . $new_user_id;

                    $adm_stmt = $conn->prepare("INSERT INTO admin_profiles (user_id, admin_code, office_room, department, designation, responsibilities, emergency_contact) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $adm_stmt->bind_param("issssss", $new_user_id, $admin_code, $office_room, $department, $designation, $responsibilities, $emergency);
                    $adm_stmt->execute();
                    $adm_stmt->close();
                } else {
                    $emp_code = 'EMP-' . (100 + $new_user_id);
                    $salary = 60000.00;
                    $joining_date = date('Y-m-d');
                    $rating = '4.5 / 5.0';

                    $emp_stmt = $conn->prepare("INSERT INTO employee_profiles (user_id, emp_code, department, designation, salary, joining_date, performance_rating) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $emp_stmt->bind_param("isssdss", $new_user_id, $emp_code, $department, $designation, $salary, $joining_date, $rating);
                    $emp_stmt->execute();
                    $emp_stmt->close();
                }

                $conn->commit();
                $success_msg = "Account created successfully for '{$username}' as {$role}! You may now log in.";
                $name = $email = $phone = $username = $department = $designation = '';
            } catch (Exception $e) {
                $conn->rollback();
                $error_msg = "Registration error: " . htmlspecialchars($e->getMessage());
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration | Apex Technologies Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="corp-header">
        <div class="nav-container">
            <a href="index.php" class="corp-brand">🏢 Apex <span>Technologies</span></a>
            <nav class="corp-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php" class="active">Register</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="auth-box">
            <div class="card">
                <h2 class="card-title" style="text-align: center;">Account Registration</h2>
                <p class="card-subtitle" style="text-align: center;">Create your corporate profile</p>

                <?php if (!empty($success_msg)): ?>
                    <div class="alert alert-success">
                        <span>&#10004;</span>
                        <div>
                            <?php echo htmlspecialchars($success_msg); ?><br>
                            <a href="login.php" style="color: #14532d; font-weight: 700; text-decoration: underline;">Proceed to Login &rarr;</a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($error_msg)): ?>
                    <div class="alert alert-danger">
                        <span>&#9888;</span>
                        <div><?php echo htmlspecialchars($error_msg); ?></div>
                    </div>
                <?php endif; ?>

                <form action="register.php" method="POST" id="companyRegisterForm">
                    
                    <div class="form-group">
                        <label for="role">Select Corporate Role *</label>
                        <select id="role" name="role" required>
                            <option value="employee" <?php echo (($role ?? '') === 'employee') ? 'selected' : ''; ?>>Employee</option>
                            <option value="admin" <?php echo (($role ?? '') === 'admin') ? 'selected' : ''; ?>>Admin (Administrator)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" placeholder="e.g. Anand Mahindra" value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Corporate Email *</label>
                        <input type="email" id="email" name="email" placeholder="e.g. anand.m@apextech.com" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" placeholder="10-digit mobile number" value="<?php echo htmlspecialchars($phone ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="department">Department *</label>
                        <input type="text" id="department" name="department" placeholder="e.g. Cloud Engineering / Operations" value="<?php echo htmlspecialchars($department ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="designation">Designation *</label>
                        <input type="text" id="designation" name="designation" placeholder="e.g. Systems Engineer / HR Director" value="<?php echo htmlspecialchars($designation ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="username">Username *</label>
                        <input type="text" id="username" name="username" placeholder="Choose a username" value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" placeholder="At least 6 characters" required>
                    </div>

                    <button type="submit" class="btn-primary">&#10004; Complete Registration</button>
                </form>

                <p style="text-align: center; margin-top: 15px; font-size: 14px; color: var(--text-muted);">
                    Already have an account? <a href="login.php" style="color: var(--primary); font-weight: 600;">Login here</a>
                </p>
            </div>
        </div>
    </main>

    <footer class="corp-footer">
        <p>&copy; 2026 Apex Technologies | IWT Laboratory Exercise 07</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
