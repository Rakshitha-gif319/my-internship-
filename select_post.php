<?php
include 'db.php';

// Get all blog posts
$sql = "SELECT id, title FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select a Post to Edit</title>
    <style>
        body {
            background: #111;
            color: #fff;
            font-family: Arial, sans-serif;
            padding: 40px;
            text-align: center;
        }

        .box {
            background: #222;
            padding: 30px;
            margin: auto;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 0 10px #0ff;
        }

        select, button {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            border-radius: 6px;
            border: none;
        }

        select {
            background-color: #1f1f1f;
            color: white;
        }

        button {
            background: #0ff;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #00dddd;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #0ff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>📝 Select a Blog Post to Edit</h2>
    <form method="GET" action="edit.php">
        <select name="id" required>
            <option value="">-- Choose a post --</option>
            <?php while($row = $result->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?></option>
            <?php endwhile; ?>
        </select>
        <button type="submit">✏️ Edit Selected Post</button>
    </form>

    <a href="index.php">⬅️ Back to Home</a>
</div>

</body>
</html>
