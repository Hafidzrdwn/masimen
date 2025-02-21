<?php
try {
  $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
  $pdo = new PDO($dsn, DB_USER, DB_PASS, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Use EXCEPTION during development
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_PERSISTENT         => false, // Prevents memory issues
  ]);
} catch (PDOException $e) {
  error_log("Database connection error: " . $e->getMessage()); // Logs error instead of exposing it
  if (defined('APP_DEBUG') && APP_DEBUG) {
    die("Database connection failed: " . $e->getMessage()); // Show error only in dev mode
  } else {
    die("Database connection failed. Please try again later."); // Hide error in production
  }
}
