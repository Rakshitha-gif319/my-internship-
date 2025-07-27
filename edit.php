<?php
include 'db.php';

if (!isset($_GET['id'])) {
    die("❌ No post ID given.");
}

$id = $_GET['id'];
$message = "";

// Fetch current post
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();

if (!$post) {
    die("❌ Post not found.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title && $content) {
        $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
        $stmt->bind_param("ssi", $title, $content, $id);

        if ($stmt->execute()) {
            $message = "✅ Post updated successfully!";
            echo "<script>setTimeout(() => window.location.href='index.php', 2000);</script>";
        } else {
            $message = "❌ Error: " . $stmt->error;
        }
    } else {
        $message = "⚠️ Title and content cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Blog ✏️</title>
    <style>
        body {
            background: #0d0d0d;
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
            padding: 40px;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: #1a1a1a;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px #00ffff;
            animation: fadeIn 0.5s ease;
        }

        h2 {
            text-align: center;
            color: #00ffff;
            margin-bottom: 20px;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            background: #262626;
            border: 1px solid #555;
            border-radius: 6px;
            color: #fff;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            width: 100%;
            background-color: #00ffff;
            color: #000;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #00e0e0;
        }

        .msg {
            margin-top: 15px;
            padding: 10px;
            text-align: center;
            color: #0f0;
            font-weight: bold;
            animation: popIn 0.6s ease;
        }

        .info {
            margin-top: 10px;
            font-size: 13px;
            color: #aaa;
            text-align: right;
        }

        .word-count {
            text-align: right;
            font-size: 13px;
            color: #999;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes popIn {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>✏️ Edit: <?= htmlspecialchars($post['title']) ?></h2>

    <?php if ($message): ?>
        <div class="msg"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST" onsubmit="return validateForm()">
        <label>Title:</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($post['title']) ?>" required>

        <label>Content:</label>
        <textarea name="content" id="content" rows="7" oninput="updateCount()" required><?= htmlspecialchars($post['content']) ?></textarea>
        <div class="word-count" id="wordCount">Words: 0</div>

        <button type="submit">💾 Save Changes</button>
    </form>

    <div class="info">Last edited: <?= date("Y-m-d H:i:s") ?></div>
</div>

<script>
function updateCount() {
    let text = document.getElementById("content").value;
    let wordCount = text.trim().split(/\s+/).filter(Boolean).length;
    document.getElementById("wordCount").innerText = "Words: " + wordCount;
}
updateCount();

function validateForm() {
    let title = document.getElementById("title").value.trim();
    let content = document.getElementById("content").value.trim();
    if (!title || !content) {
        alert("⚠️ Please fill in both fields!");
        return false;
    }
    return true;
}
</script>

</body>
</html>
