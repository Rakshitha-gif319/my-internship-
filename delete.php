<?php
include 'db.php';

if (!isset($_GET['id'])) {
    die("❌ No post ID provided.");
}

$id = $_GET['id'];

// Check if post exists
$check = $conn->prepare("SELECT id FROM posts WHERE id = ?");
$check->bind_param("i", $id);
$check->execute();
$result = $check->get_result();

if ($result->num_rows === 0) {
    die("⚠️ Post not found.");
}

// Delete the post
$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('🗑️ Post deleted successfully!'); window.location.href='index.php';</script>";
} else {
    echo "❌ Error deleting post: " . $stmt->error;
}

$conn->close();
?>
