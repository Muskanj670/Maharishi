<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = "";
$dbname = "maharishi_db";

// $servername = "sql301.infinityfree.com";
// $username = "if0_38428339"; // Change if needed
// $password = "2OihBSB58q9Pxj";
// $dbname = "if0_38428339_maharishi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if not exists
$tableQuery = "CREATE TABLE IF NOT EXISTS maharishis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE,
    title CHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL
)";
$conn->query($tableQuery);
?>
