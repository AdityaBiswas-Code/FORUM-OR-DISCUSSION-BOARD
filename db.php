<?php
// db.php - Database connection & session setup

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Connect to Localhost Database (XAMPP)
$conn = new mysqli('127.0.0.1', 'root', '', 'Quaddit');
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

// Helper: Escape HTML output to prevent XSS
if (!function_exists('e')) {
    function e(?string $str = ''): string {
        return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
    }
}

// Helper: Check if user is logged in
if (!function_exists('is_logged_in')) {
    function is_logged_in(): bool {
        return !empty($_SESSION['user_id']);
    }
}
