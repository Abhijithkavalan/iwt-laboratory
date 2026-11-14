<?php
/**
 * IWT Exercise 08: Delete Contact Handler (CRUD: Delete)
 */
require_once 'db.php';

$id = intval($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $stmt->close();
        header('Location: index.php?msg=deleted');
        exit;
    } else {
        $stmt->close();
        header('Location: index.php?msg=error');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>
