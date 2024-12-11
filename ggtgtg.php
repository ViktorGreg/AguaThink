<?php
session_start();
require_once "database.php"; // Ensure this file correctly connects to your database

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Fetch the current user's data
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        die("User not found.");
    }
} else {
    die("Failed to prepare the statement.");
}

// Handle username update
if (isset($_POST["update_username"])) {
    $new_username = $_POST["username"];
    if (!empty($new_username)) {
        $update_sql = "UPDATE users SET username = ? WHERE id = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        if ($update_stmt) {
            mysqli_stmt_bind_param($update_stmt, "si", $new_username, $user_id);
            if (mysqli_stmt_execute($update_stmt)) {
                $_SESSION["username"] = $new_username;
                header("Location: profile.php");
                exit();
            } else {
                $error_message = "Failed to update username.";
            }
        } else {
            die("Failed to prepare the update statement.");
        }
    } else {
        $error_message = "Username cannot be empty.";
    }
}

// Fetch posts by the logged-in user
$post_sql = "SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC";
$post_stmt = mysqli_prepare($conn, $post_sql);
if ($post_stmt) {
    mysqli_stmt_bind_param($post_stmt, "i", $user_id);
    mysqli_stmt_execute($post_stmt);
    $post_result = mysqli_stmt_get_result($post_stmt);
} else {
    die("Failed to prepare the statement for posts.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="homePage.css"> <!-- Ensure consistent styling -->
</head>
<body>
    <header class="header-top">
        <h1 style="text-align: center; color: white; cursor: pointer; display: inline; padding-left: 15px;">AguaThink</h1>
        <nav class="navigation">
            <a href="homePage.php">Home</a>
            <a onclick="openPop()">Post</a> <!-- Post button opens the popup -->
            <a href="weather.html">Weather</a>
            <a href="">Evacuation Site</a>
        </nav>
    </header>

    <div class="container">
        <div class="picture">
            <img class="profile-picture" src="empty.webp" alt="Profile Picture">
            <h1><?php echo htmlspecialchars($user["username"]); ?></h1>
            <form method="POST" action="profile.php">
                <label for="username">Edit Username:</label>
                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user["username"]); ?>">
                <button type="submit" name="update_username">Update</button>
            </form>
            <p><?php echo htmlspecialchars($user["email"]); ?></p>
            <p>Hi, I'm <?php echo htmlspecialchars($user["username"]); ?></p>
            <hr style="font-weight: bold; width: 90%;">
        </div>

        <!-- Post creation modal -->
        <div class="topup" id="popUp" style="display: none;">
            <div class="topup-content">
                <form action="add_post.php" method="post">
                    <p><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                    <textarea name="content" placeholder="Write a post here." required></textarea><br>
                    <button type="submit" name="submit" class="btn">Upload</button>
                    <button type="button" class="btn" onclick="closePop()">Cancel</button>
                </form>
            </div>
        </div>

        <h1 style="padding-left: 35px;">Your Posts</h1>
        <?php if (mysqli_num_rows($post_result) > 0): ?>
            <?php while ($post = mysqli_fetch_assoc($post_result)): ?>
                <div class="upload">
                    <p style="font-size: 15px;"><?php echo htmlspecialchars($user["username"]); ?></p>
                    <p style="font-size: 10px;"><?php echo date("F j, Y, g:i a", strtotime($post["created_at"])); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($post["content"])); ?></p>
                    
                    <form method="GET" action="edit_post.php" style="display:inline;">
                        <input type="hidden" name="post_id" value="<?php echo $post["id"]; ?>">
                        <button type="submit">Edit</button>
                    </form>
                    <form method="POST" action="delete_post.php" style="display:inline;">
                        <input type="hidden" name="post_id" value="<?php echo $post["id"]; ?>">
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No posts available.</p>
        <?php endif; ?>
    </div>

    <script>
        function openPop() {
            document.getElementById("popUp").style.display = "flex";
        }

        function closePop() {
            document.getElementById("popUp").style.display = "none";
        }
    </script>
</body>
</html>