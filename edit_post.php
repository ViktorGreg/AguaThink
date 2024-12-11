<?php
session_start();
require_once "database.php";

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Validate post_id
if (!isset($_GET["post_id"]) || empty($_GET["post_id"])) {
    die("Post ID is required.");
}

$post_id = intval($_GET["post_id"]);

// Fetch the post
$sql = "SELECT * FROM posts WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ii", $post_id, $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $post = mysqli_fetch_assoc($result);
    if (!$post) {
        die("Post not found or you are not authorized to edit this post.");
    }
} else {
    die("Failed to prepare the statement: " . mysqli_error($conn));
}

// Handle post update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $updated_content = trim($_POST["content"]);

    if (!empty($updated_content)) {
        $update_sql = "UPDATE posts SET content = ? WHERE id = ? AND user_id = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        if ($update_stmt) {
            mysqli_stmt_bind_param($update_stmt, "sii", $updated_content, $post_id, $user_id);
            if (mysqli_stmt_execute($update_stmt)) {
                // Redirect to the profile page
                header("Location: profile.php");
                exit();
            } else {
                $error_message = "Failed to update the post: " . mysqli_error($conn);
            }
        } else {
            die("Failed to prepare the update statement: " . mysqli_error($conn));
        }
    } else {
        $error_message = "Post content cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homePage.css">
    <title>Edit Post</title>
</head>
<body>
    <header class="header-top">
        <h1 style="color: white; padding-left: 12px; padding-bottom: 15px;">AguaThink</h1>
        <nav class="navigation">
            <a href="homePage.php">Home</a>
            <a href="profile.php">Profile</a>
        </nav>
    </header>

    <div class="container">
        <h2>Edit Post</h2>
        <?php if (!empty($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <textarea name="content" rows="10" cols="50" required><?php echo htmlspecialchars($post["content"]); ?></textarea><br>
            <button type="submit" class="btn">Update Post</button>
            <a href="profile.php" class="btn">Cancel</a>
        </form>
    </div>
</body>
</html>
