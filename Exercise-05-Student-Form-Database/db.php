<?php
/**
 * Database Connection Configuration
 * Project: IWT Exercise 05 - Employee Management Form
 * Database: iwt_exercise5
 */

// Database credentials (default XAMPP configuration)
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'iwt_exercise5';

// Enable mysqli error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Establish connection to MySQL
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    // Set charset to utf8mb4 for universal character support
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    // Graceful error display if database has not been imported or MySQL is stopped
    die("
    <div style='font-family: sans-serif; max-width: 600px; margin: 50px auto; padding: 25px; border-left: 5px solid #ef4444; background: #fee2e2; border-radius: 6px;'>
        <h3 style='color: #991b1b; margin-top: 0;'>Database Connection Failed</h3>
        <p style='color: #7f1d1d;'>Could not connect to MySQL database <strong>{$db_name}</strong>.</p>
        <p style='color: #7f1d1d; font-size: 14px;'><strong>Reason:</strong> " . htmlspecialchars($e->getMessage()) . "</p>
        <hr style='border: 0; border-top: 1px solid #f87171; margin: 15px 0;'>
        <p style='font-size: 13px; color: #4b5563;'>
            <strong>Troubleshooting Steps:</strong><br>
            1. Ensure Apache and MySQL are running in the XAMPP Control Panel.<br>
            2. Open phpMyAdmin (<code>http://localhost/phpmyadmin/</code>).<br>
            3. Import the <code>database.sql</code> file included in this project directory.
        </p>
    </div>
    ");
}
?>
