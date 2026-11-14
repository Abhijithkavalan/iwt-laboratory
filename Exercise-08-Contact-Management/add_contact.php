<?php
/**
 * IWT Exercise 08: Add New Contact (CRUD: Create)
 */
require_once 'db.php';

$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contact_id = trim($_POST['contact_id'] ?? '');
    $name       = trim($_POST['name'] ?? '');
    $phone      = trim($_POST['phone'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $address    = trim($_POST['address'] ?? '');
    $category   = trim($_POST['category'] ?? 'Work');

    if (empty($contact_id) || empty($name) || empty($phone) || empty($email) || empty($address) || empty($category)) {
        $error_msg = 'All contact fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = 'Please provide a valid email address.';
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $error_msg = 'Phone number must be exactly 10 digits.';
    } else {
        // Check for duplicate contact_id
        $check_stmt = $conn->prepare("SELECT id FROM contacts WHERE contact_id = ?");
        $check_stmt->bind_param("s", $contact_id);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $error_msg = 'A contact with this Contact ID already exists. Please choose a unique ID.';
            $check_stmt->close();
        } else {
            $check_stmt->close();

            $stmt = $conn->prepare("INSERT INTO contacts (contact_id, name, phone, email, address, category) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $contact_id, $name, $phone, $email, $address, $category);

            if ($stmt->execute()) {
                $stmt->close();
                header('Location: index.php?msg=added');
                exit;
            } else {
                $error_msg = "Database insert failed: " . htmlspecialchars($stmt->error);
                $stmt->close();
            }
        }
    }
} else {
    // Generate suggested default Contact ID based on max ID
    $auto_id_res = $conn->query("SELECT MAX(id) as max_id FROM contacts");
    $max_id_row  = $auto_id_res->fetch_assoc();
    $next_id     = ($max_id_row['max_id'] ?? 0) + 1;
    $contact_id  = 'CNT-' . str_pad($next_id, 3, '0', STR_PAD_LEFT);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contact | ContactSphere</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="app-header">
        <div class="nav-container">
            <a href="index.php" class="app-brand">📇 Contact<span>Sphere</span> Manager</a>
            <div class="nav-actions">
                <a href="index.php" class="btn-reset">&larr; Back to Contacts List</a>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="card form-card">
            <h2 style="font-size: 22px; color: var(--secondary); margin-bottom: 6px;">Add New Contact</h2>
            <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 20px;">Enter details to store a new entry into the MySQL contacts database.</p>

            <?php if (!empty($error_msg)): ?>
                <div class="alert alert-danger">
                    <span>&#9888;</span>
                    <div><?php echo htmlspecialchars($error_msg); ?></div>
                </div>
            <?php endif; ?>

            <form action="add_contact.php" method="POST" id="contactForm">
                
                <div class="form-group">
                    <label for="contact_id">Contact ID (Unique) *</label>
                    <input type="text" id="contact_id" name="contact_id" value="<?php echo htmlspecialchars($contact_id ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="name">Contact Full Name *</label>
                    <input type="text" id="name" name="name" placeholder="e.g. Vikramaditya Sen" value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="phone">Mobile Phone (10 digits) *</label>
                    <input type="tel" id="phone" name="phone" placeholder="e.g. 9876543210" value="<?php echo htmlspecialchars($phone ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" placeholder="e.g. vikram.sen@domain.com" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="category">Contact Category *</label>
                    <select id="category" name="category" required>
                        <option value="Work" <?php echo (($category ?? '') === 'Work') ? 'selected' : ''; ?>>Work / Professional</option>
                        <option value="Family" <?php echo (($category ?? '') === 'Family') ? 'selected' : ''; ?>>Family</option>
                        <option value="Friends" <?php echo (($category ?? '') === 'Friends') ? 'selected' : ''; ?>>Friends</option>
                        <option value="Academic" <?php echo (($category ?? '') === 'Academic') ? 'selected' : ''; ?>>Academic / University</option>
                        <option value="Emergency" <?php echo (($category ?? '') === 'Emergency') ? 'selected' : ''; ?>>Emergency Contact</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="address">Postal Address *</label>
                    <textarea id="address" name="address" rows="3" placeholder="Enter complete residential or office street address" required><?php echo htmlspecialchars($address ?? ''); ?></textarea>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">&#10004; Save Contact Entry</button>
                </div>

            </form>
        </div>
    </main>

    <footer class="app-footer">
        <p>&copy; 2026 ContactSphere Management System | IWT Laboratory Exercise 08</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
