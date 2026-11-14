<?php
/**
 * IWT Exercise 08: View and Search Contacts (CRUD: Read & Search)
 */
require_once 'db.php';

$search_keyword  = trim($_GET['search'] ?? '');
$filter_category = trim($_GET['category'] ?? '');

$sql = "SELECT * FROM contacts WHERE 1=1";
$params = [];
$types = "";

if (!empty($search_keyword)) {
    $sql .= " AND (name LIKE ? OR phone LIKE ? OR email LIKE ?)";
    $like_term = "%" . $search_keyword . "%";
    $params[] = $like_term;
    $params[] = $like_term;
    $params[] = $like_term;
    $types .= "sss";
}

if (!empty($filter_category)) {
    $sql .= " AND category = ?";
    $params[] = $filter_category;
    $types .= "s";
}

$sql .= " ORDER BY id DESC";

$stmt = $conn->prepare($sql);
if (!empty($types)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$total_count = $result ? $result->num_rows : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management System | IWT Exercise 08</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="app-header">
        <div class="nav-container">
            <a href="index.php" class="app-brand">📇 Contact<span>Sphere</span> Manager</a>
            <div class="nav-actions">
                <a href="add_contact.php" class="btn-header">+ Add New Contact</a>
            </div>
        </div>
    </header>

    <main class="main-content">
        
        <!-- Alerts for CRUD Notifications -->
        <?php if (isset($_GET['msg'])): ?>
            <?php if ($_GET['msg'] === 'added'): ?>
                <div class="alert alert-success">&#10004; Contact created and saved successfully!</div>
            <?php elseif ($_GET['msg'] === 'updated'): ?>
                <div class="alert alert-success">&#10004; Contact details updated successfully!</div>
            <?php elseif ($_GET['msg'] === 'deleted'): ?>
                <div class="alert alert-success">&#10004; Contact entry deleted successfully!</div>
            <?php elseif ($_GET['msg'] === 'error'): ?>
                <div class="alert alert-danger">&#9888; An error occurred while executing the operation.</div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="card">
            
            <!-- Search & Filter Controls -->
            <div class="controls-bar">
                <form action="index.php" method="GET" class="search-form">
                    <input type="text" name="search" class="search-input" placeholder="Search by name, phone or email..." value="<?php echo htmlspecialchars($search_keyword); ?>">
                    
                    <select name="category" class="search-select">
                        <option value="">All Categories</option>
                        <option value="Work" <?php echo ($filter_category === 'Work') ? 'selected' : ''; ?>>Work</option>
                        <option value="Family" <?php echo ($filter_category === 'Family') ? 'selected' : ''; ?>>Family</option>
                        <option value="Friends" <?php echo ($filter_category === 'Friends') ? 'selected' : ''; ?>>Friends</option>
                        <option value="Academic" <?php echo ($filter_category === 'Academic') ? 'selected' : ''; ?>>Academic</option>
                        <option value="Emergency" <?php echo ($filter_category === 'Emergency') ? 'selected' : ''; ?>>Emergency</option>
                    </select>

                    <button type="submit" class="btn-search">Search</button>
                    
                    <?php if (!empty($search_keyword) || !empty($filter_category)): ?>
                        <a href="index.php" class="btn-reset">Reset</a>
                    <?php endif; ?>
                </form>

                <div>
                    <span style="font-size: 13.5px; font-weight: 600; color: var(--text-muted);">
                        Found <strong><?php echo $total_count; ?></strong> contact(s)
                    </span>
                </div>
            </div>

            <!-- Contacts Data Table -->
            <?php if ($total_count > 0): ?>
                <div class="table-responsive">
                    <table class="contacts-table">
                        <thead>
                            <tr>
                                <th>Contact ID</th>
                                <th>Full Name</th>
                                <th>Phone Number</th>
                                <th>Email Address</th>
                                <th>Category</th>
                                <th>Residential Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($contact = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><code><?php echo htmlspecialchars($contact['contact_id']); ?></code></td>
                                    <td><strong><?php echo htmlspecialchars($contact['name']); ?></strong></td>
                                    <td>📞 <a href="tel:<?php echo htmlspecialchars($contact['phone']); ?>" style="color: inherit; text-decoration: none;"><?php echo htmlspecialchars($contact['phone']); ?></a></td>
                                    <td>✉️ <a href="mailto:<?php echo htmlspecialchars($contact['email']); ?>" style="color: var(--primary); text-decoration: none;"><?php echo htmlspecialchars($contact['email']); ?></a></td>
                                    <td>
                                        <span class="cat-badge cat-<?php echo htmlspecialchars($contact['category']); ?>">
                                            <?php echo htmlspecialchars($contact['category']); ?>
                                        </span>
                                    </td>
                                    <td style="max-width: 250px; font-size: 13px;"><?php echo htmlspecialchars($contact['address']); ?></td>
                                    <td>
                                        <div class="action-links">
                                            <a href="edit_contact.php?id=<?php echo $contact['id']; ?>" class="btn-action btn-edit" title="Edit Contact">✏️ Edit</a>
                                            <a href="delete_contact.php?id=<?php echo $contact['id']; ?>" class="btn-action btn-delete" onclick="return confirmDelete('<?php echo addslashes($contact['name']); ?>')" title="Delete Contact">🗑️ Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div style="text-align: center; padding: 40px 20px;">
                    <p style="font-size: 16px; color: var(--text-muted); margin-bottom: 15px;">No contacts found matching your search filter.</p>
                    <a href="add_contact.php" class="btn-header">+ Add New Contact Entry</a>
                </div>
            <?php endif; ?>

        </div>

    </main>

    <footer class="app-footer">
        <p>&copy; 2026 ContactSphere Management System | IWT Laboratory Exercise 08</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
