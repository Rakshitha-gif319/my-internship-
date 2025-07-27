<?php
$conn = new mysqli("localhost", "root", "", "blog");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL for users table
$userTable = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

// SQL for posts table
$postTable = "CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Run both queries
if ($conn->query($userTable) === TRUE && $conn->query($postTable) === TRUE) {
    echo "✅ Tables created successfully!";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>
