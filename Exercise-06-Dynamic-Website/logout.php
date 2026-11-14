<?php
/**
 * IWT Exercise 06: Logout Handler
 * Destroys active session and redirects to login
 */
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy session cookie if set
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destroy session
session_destroy();

// Redirect to login page with logout notice
header('Location: login.php?logout=success');
exit;
?>
