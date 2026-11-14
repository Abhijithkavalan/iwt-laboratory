<?php
/**
 * Database Connection: Exercise 08 Contact Management
 * Database: iwt_exercise8
 */

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'iwt_exercise8';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    die("
    <div style='font-family: sans-serif; max-width: 600px; margin: 50px auto; padding: 25px; border-left: 5px solid #ef4444; background: #fee2e2; border-radius: 6px;'>
        <h3 style='color: #991b1b; margin-top: 0;'>Database Connection Error</h3>
        <p style='color: #7f1d1d;'>Could not connect to MySQL database <strong>{$db_name}</strong>.</p>
        <p style='color: #7f1d1d; font-size: 14px;'><strong>Reason:</strong> " . htmlspecialchars($e->getMessage()) . "</p>
        <hr style='border: 0; border-top: 1px solid #f87171; margin: 15px 0;'>
        <p style='font-size: 13px; color: #4b5563;'>
            <strong>Setup Note:</strong> Ensure MySQL is active in XAMPP and <code>database.sql</code> is imported into phpMyAdmin.
        </p>
    </div>
    ");
}
?>
