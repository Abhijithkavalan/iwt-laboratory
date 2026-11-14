<?php
/**
 * IWT Exercise 05: Employee Registration Form
 * Technologies: HTML5, CSS3, PHP, MySQL, phpMyAdmin
 */

require_once 'db.php';

$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve input values
    $emp_id      = trim($_POST['emp_id'] ?? '');
    $full_name   = trim($_POST['full_name'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $phone       = trim($_POST['phone'] ?? '');
    $gender      = trim($_POST['gender'] ?? '');
    $dob         = trim($_POST['dob'] ?? '');
    $department  = trim($_POST['department'] ?? '');
    $designation = trim($_POST['designation'] ?? '');
    $salary      = trim($_POST['salary'] ?? '');
    $address     = trim($_POST['address'] ?? '');

    // Server-side validation
    if (empty($emp_id) || empty($full_name) || empty($email) || empty($phone) || 
        empty($gender) || empty($dob) || empty($department) || empty($designation) || 
        empty($salary) || empty($address)) {
        $error_message = 'All fields are mandatory. Please complete the entire form.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Invalid email format. Please provide a valid email address.';
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $error_message = 'Invalid phone number. Must be exactly 10 numeric digits.';
    } elseif (!is_numeric($salary) || floatval($salary) <= 0) {
        $error_message = 'Salary must be a positive numeric value.';
    } else {
        // Check if Employee ID or Email already exists
        $check_stmt = $conn->prepare("SELECT id FROM employees WHERE emp_id = ? OR email = ?");
        $check_stmt->bind_param("ss", $emp_id, $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $error_message = 'An employee with this Employee ID or Email address is already registered.';
            $check_stmt->close();
        } else {
            $check_stmt->close();

            // Insert new record using secure Prepared Statement
            $stmt = $conn->prepare("INSERT INTO employees (emp_id, full_name, email, phone, gender, dob, department, designation, salary, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $salary_val = floatval($salary);
            $stmt->bind_param("ssssssssds", $emp_id, $full_name, $email, $phone, $gender, $dob, $department, $designation, $salary_val, $address);

            if ($stmt->execute()) {
                $success_message = "Employee record for '{$full_name}' (ID: {$emp_id}) has been successfully saved to the database!";
                // Reset form values on successful insert
                $emp_id = $full_name = $email = $phone = $gender = $dob = $department = $designation = $salary = $address = '';
            } else {
                $error_message = "Database execution error: " . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration Form | IWT Exercise 05</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navigation Header -->
    <header class="navbar">
        <div class="nav-container">
            <a href="index.php" class="brand">🏢 TechCorp Employee Portal</a>
            <ul class="nav-links">
                <li><a href="index.php" class="active">New Registration</a></li>
                <li><a href="view_employees.php">View All Employees</a></li>
            </ul>
        </div>
    </header>

    <div class="container">
        <div class="card">
            
            <div class="card-header">
                <h2>Employee Registration Form</h2>
                <p>Fill out the required employee details below to store them into the phpMyAdmin MySQL database.</p>
            </div>

            <!-- Notification Messages -->
            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success">
                    <span>&#10004;</span>
                    <div><?php echo htmlspecialchars($success_message); ?></div>
                </div>
            <?php endif; ?>

            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger">
                    <span>&#9888;</span>
                    <div><?php echo htmlspecialchars($error_message); ?></div>
                </div>
            <?php endif; ?>

            <!-- Registration Form -->
            <form action="index.php" method="POST" id="employeeForm">
                <div class="form-grid">
                    
                    <!-- 1. Employee ID -->
                    <div class="form-group">
                        <label for="emp_id">Employee ID <span class="required">*</span></label>
                        <input type="text" id="emp_id" name="emp_id" placeholder="e.g. EMP104" value="<?php echo htmlspecialchars($emp_id ?? ''); ?>" required>
                    </div>

                    <!-- 2. Full Name -->
                    <div class="form-group">
                        <label for="full_name">Employee Full Name <span class="required">*</span></label>
                        <input type="text" id="full_name" name="full_name" placeholder="e.g. Rajesh Nair" value="<?php echo htmlspecialchars($full_name ?? ''); ?>" required>
                    </div>

                    <!-- 3. Email -->
                    <div class="form-group">
                        <label for="email">Corporate Email Address <span class="required">*</span></label>
                        <input type="email" id="email" name="email" placeholder="e.g. rajesh.nair@techcorp.com" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                    </div>

                    <!-- 4. Phone -->
                    <div class="form-group">
                        <label for="phone">Contact Phone Number <span class="required">*</span></label>
                        <input type="tel" id="phone" name="phone" placeholder="10-digit mobile number" value="<?php echo htmlspecialchars($phone ?? ''); ?>" required>
                    </div>

                    <!-- 5. Gender -->
                    <div class="form-group">
                        <label>Gender <span class="required">*</span></label>
                        <div class="radio-group">
                            <label><input type="radio" name="gender" value="Male" <?php echo (($gender ?? '') === 'Male') ? 'checked' : ''; ?> required> Male</label>
                            <label><input type="radio" name="gender" value="Female" <?php echo (($gender ?? '') === 'Female') ? 'checked' : ''; ?>> Female</label>
                            <label><input type="radio" name="gender" value="Other" <?php echo (($gender ?? '') === 'Other') ? 'checked' : ''; ?>> Other</label>
                        </div>
                    </div>

                    <!-- 6. Date of Birth -->
                    <div class="form-group">
                        <label for="dob">Date of Birth <span class="required">*</span></label>
                        <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($dob ?? ''); ?>" required>
                    </div>

                    <!-- 7. Department -->
                    <div class="form-group">
                        <label for="department">Department <span class="required">*</span></label>
                        <select id="department" name="department" required>
                            <option value="">-- Select Department --</option>
                            <option value="Computer Science" <?php echo (($department ?? '') === 'Computer Science') ? 'selected' : ''; ?>>Computer Science</option>
                            <option value="Information Technology" <?php echo (($department ?? '') === 'Information Technology') ? 'selected' : ''; ?>>Information Technology</option>
                            <option value="Human Resources" <?php echo (($department ?? '') === 'Human Resources') ? 'selected' : ''; ?>>Human Resources</option>
                            <option value="Finance & Accounts" <?php echo (($department ?? '') === 'Finance & Accounts') ? 'selected' : ''; ?>>Finance &amp; Accounts</option>
                            <option value="Research & Development" <?php echo (($department ?? '') === 'Research & Development') ? 'selected' : ''; ?>>Research &amp; Development</option>
                            <option value="Operations" <?php echo (($department ?? '') === 'Operations') ? 'selected' : ''; ?>>Operations</option>
                        </select>
                    </div>

                    <!-- 8. Designation -->
                    <div class="form-group">
                        <label for="designation">Designation <span class="required">*</span></label>
                        <input type="text" id="designation" name="designation" placeholder="e.g. Software Engineer" value="<?php echo htmlspecialchars($designation ?? ''); ?>" required>
                    </div>

                    <!-- 9. Salary -->
                    <div class="form-group">
                        <label for="salary">Monthly Salary (INR) <span class="required">*</span></label>
                        <input type="number" id="salary" name="salary" step="0.01" min="1" placeholder="e.g. 65000.00" value="<?php echo htmlspecialchars($salary ?? ''); ?>" required>
                    </div>

                    <!-- 10. Address -->
                    <div class="form-group full-width">
                        <label for="address">Residential Address <span class="required">*</span></label>
                        <textarea id="address" name="address" rows="3" placeholder="Enter complete residential street address, city and postal pin code" required><?php echo htmlspecialchars($address ?? ''); ?></textarea>
                    </div>

                    <!-- Form Submission Buttons -->
                    <div class="form-actions">
                        <button type="reset" class="btn btn-secondary">Clear Form</button>
                        <button type="submit" class="btn btn-primary">&#10004; Submit &amp; Save Employee</button>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <!-- Client-side script -->
    <script src="script.js"></script>
</body>
</html>
