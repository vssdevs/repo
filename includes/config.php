<?php
// Database credentials
$host = 'localhost';
$dbname = 'vss_db';
$username = 'vssadmin';
$password = 'Kk9566678@!';
// PDO connection string
$dsn = "mysql:host=$host;dbname=$dbname";

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $username, $password);
    
    // Set PDO attributes for error mode and exception handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Output error message if connection fails
    echo "Connection failed: " . $e->getMessage();
}
?>
