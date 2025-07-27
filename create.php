<?php
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts (title, content) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        $message = "✅ Post added successfully!";
    } else {
        $message = "❌ Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create a Unique Post</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #121212;
            color: #fff;
            padding: 40px;
        }
        h1 {
            color: #0ff;
        }
        form {
            background: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #0ff;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            background-color: #2e2e2e;
            color: white;
        }
        button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #0ff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: black;
            font-weight: bold;
        }
        .message {
            margin-top: 20px;
            font-size: 1.2em;
            color: lightgreen;
        }
        a {
            color: #0ff;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <h1>🚀 Write a Unique Blog Post</h1>

    <?php if ($message): ?>
        <div class="message"><?= $message ?> <a href="index.php">Go to Posts</a></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Post Title</label>
        <input type="text" name="title" placeholder="Enter a creative title..." required>

        <label>Post Content</label>
        <textarea name="content" rows="6" placeholder="Write your thoughts, ideas, or poetry..." required></textarea>

        <button type="submit">🚀 Add Post</button>
    </form>

</body>
</html>
