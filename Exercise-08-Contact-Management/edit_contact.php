<?php
/**
 * IWT Exercise 08: Edit Contact (CRUD: Update)
 */
require_once 'db.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$error_msg = '';

// Handle form update submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name       = trim($_POST['name'] ?? '');
    $phone      = trim($_POST['phone'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $address    = trim($_POST['address'] ?? '');
    $category   = trim($_POST['category'] ?? 'Work');

    if (empty($name) || empty($phone) || empty($email) || empty($address) || empty($category)) {
        $error_msg = 'All contact fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = 'Please provide a valid email address.';
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $error_msg = 'Phone number must be exactly 10 digits.';
    } else {
        $stmt = $conn->prepare("UPDATE contacts SET name = ?, phone = ?, email = ?, address = ?, category = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $name, $phone, $email, $address, $category, $id);

        if ($stmt->execute()) {
            $stmt->close();
            header('Location: index.php?msg=updated');
            exit;
        } else {
            $error_msg = 'Update failed: ' . htmlspecialchars($stmt->error);
            $stmt->close();
        }
    }
}

// Fetch existing contact record for pre-filling form
$stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$contact = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$contact) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact | ContactSphere</title>
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
            <h2 style="font-size: 22px; color: var(--secondary); margin-bottom: 6px;">
                Edit Contact: <code><?php echo htmlspecialchars($contact['contact_id']); ?></code>
            </h2>
            <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 20px;">Modify contact details and click save to update the MySQL record.</p>

            <?php if (!empty($error_msg)): ?>
                <div class="alert alert-danger">
                    <span>&#9888;</span>
                    <div><?php echo htmlspecialchars($error_msg); ?></div>
                </div>
            <?php endif; ?>

            <form action="edit_contact.php?id=<?php echo $id; ?>" method="POST" id="contactForm">
                
                <div class="form-group">
                    <label>Contact ID (Read-Only)</label>
                    <input type="text" value="<?php echo htmlspecialchars($contact['contact_id']); ?>" disabled style="background-color: #e2e8f0; cursor: not-allowed;">
                </div>

                <div class="form-group">
                    <label for="name">Contact Full Name *</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($contact['name']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number (10 digits) *</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($contact['phone']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($contact['email']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="category">Category *</label>
                    <select id="category" name="category" required>
                        <option value="Work" <?php echo ($contact['category'] === 'Work') ? 'selected' : ''; ?>>Work / Professional</option>
                        <option value="Family" <?php echo ($contact['category'] === 'Family') ? 'selected' : ''; ?>>Family</option>
                        <option value="Friends" <?php echo ($contact['category'] === 'Friends') ? 'selected' : ''; ?>>Friends</option>
                        <option value="Academic" <?php echo ($contact['category'] === 'Academic') ? 'selected' : ''; ?>>Academic / University</option>
                        <option value="Emergency" <?php echo ($contact['category'] === 'Emergency') ? 'selected' : ''; ?>>Emergency Contact</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="address">Postal Address *</label>
                    <textarea id="address" name="address" rows="3" required><?php echo htmlspecialchars($contact['address']); ?></textarea>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">&#10004; Update Contact</button>
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
