<?php
// db.php - Database connection & session setup

// 1. Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Database credentials (Localhost vs Live Hosting)
$is_local = in_array($_SERVER['HTTP_HOST'] ?? '', ['localhost', '127.0.0.1'])
    || strpos($_SERVER['HTTP_HOST'] ?? '', 'localhost') !== false;

if ($is_local) {
    // Localhost (XAMPP)
    $host = '127.0.0.1';
    $dbname = 'Quaddit';
    $user = 'root';
    $pass = '';
} else {
    // Live Hosting (InfinityFree)
    $host = 'sql302.infinityfree.com';
    $dbname = 'if0_43149342_Quaddit';
    $user = 'if0_43149342';
    $pass = 'Quaddit007';
}

// 3. Connect to MySQL using MySQLi
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Set character set to utf8mb4
$conn->set_charset("utf8mb4");

// 4. Helper: Escape output to prevent XSS
if (!function_exists('e')) {
    /**
     * Escape string to prevent XSS.
     *
     * @param string|null $str
     * @return string
     */
    function e(?string $str = null): string {
        return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
    }
}

// 5. Helper: Check if user is logged in
if (!function_exists('is_logged_in')) {
    /**
     * Check if current session user is logged in.
     *
     * @return bool
     */
    function is_logged_in(): bool {
        return !empty($_SESSION['user_id']);
    }
}
