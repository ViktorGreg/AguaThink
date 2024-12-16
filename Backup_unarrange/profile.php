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
    <!-- <link rel="stylesheet" href="profile.css"> -->
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
        }
        body {
            margin: 0;
        }
        .header-top{
            padding-top: 0.1px;
            background-color: #55c595;
            width: 100vw;
        }
        .navigation {
            display: flex;
            justify-content: space-evenly;
        }

        .navigation a{
            padding-top: 15px;
            cursor: pointer;
            justify-content: center;
            align-items: center;
            text-align: center;
            border: none;
            text-decoration: none;
            color: white;
            width: 200px;
            height: 40px;
        }
        .navigation a:hover{
            color: black;
            background-color: whitesmoke;
            transition: 0.3s;
            border: none;
        }
        .navigation button{
            font-weight: bold;
            width: 25%;
            height: 30px;
            background: transparent;
            border: none;
        }
        .navigation-2 a{
            padding-left: 45px;
            margin: 15px;
            height: 50px;
            width: 100%;
            text-decoration: none;
            color: black;
        }
        .navigation-2 {
            display: flex;
            align-items: center;
            flex-direction: column;
            padding-top: 35px;
            height: 100vh;
            background-color: #3b9b9d;
            width: 25%;
        }
        .navigation-2 button {
            cursor: pointer;
            margin-bottom: 15px;
            background-color: #f0faff;
            height: 55px;
            width: 85%;
            border: none;
            text-decoration: none;
        }
        .navigation-2 button:hover {
            background-color: #d4e0e6;
            box-shadow: 3px 4px black;
        }
        .navigation button:hover {
            background-color: #d4e0e6;
            box-shadow: 3px 4px 15px black;
            transition: 0.3s;
            color: black;
        }

        .container {
            display: flex;
        }

        .upload {
            border-radius: 10px;
            background-color: rgb(231, 230, 230);
            margin-top: 55px;
            margin-left: 100px;
            padding-left: 25px;
            padding-top: 5px;
            padding-right: 20px;
            height: 1fr;
            width: 800px;
        }

        .upload button{
            border: none;
            height: 50px;
            width: 33%;
            background-color: #f0faff;
            color: black;
            margin-bottom: 15px;
        }
        .upload button:hover{
            background-color: #d4e0e6;
            box-shadow: 3px 4px black;
        }
        .pop-up {
            border-radius: 10px;
            display: none;
            background-color: rgb(231, 230, 230);
            margin: 55px;
            margin-left: 100px;
            padding-top: 5px;
            padding-left: 25px;
            padding-right: 20px;
            height: 1fr;
            width: 800px;

        }
        .btn{
            border: none;
            height: 50px;
            width: 100%;
            background-color: #d5e5ec;
            color: black;
            margin-bottom: 15px;
        }
        .btn:hover{
            background-color: #d4e0e6;
            box-shadow: 3px 4px black;
        }
        textarea{
            resize: none;
            border: none;
            width: 99.5%;
            height: 250px;
            font-size: 18px;
        }
        textarea::placeholder {
            font-size: 18px;
        }

        .topup {
        background: rgb(0, 0, 0, 0.6);
        height: 100%;
        width: 100%;
        position: absolute;
        top: 0;
        display: none;
        justify-content: center;
        align-items: center;
}
.topup-content {
        height: 430px;
        width: 500px;
        background: white;
        padding: 20px;
        border-radius: 5px;
        position: relative;
}
        .container{
            display: flex;
            flex-direction: column;
            justify-content: center;

                }
        .profile-picture{
            border: solid;
            border-radius: 50%;
            width: 15%;
        }
        .picture{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding-top: 50px;
                }
        .user-edit{
            width: 90%;
            font-size: 1.2em;
            border-top: 1px solid;
            border-bottom: 1px solid;
            display: flex;
            justify-content: center;
            flex-direction: column;

        }
        .user-edit input{
            width: 250px; 
            border: none; 
            box-shadow: 1px 1px 1px black; 
            border-radius: 5px
        }
        .user-edit button{
            border: none;
            padding: 5px;
            width: 100px;
            font-size: 14px;
            height: 35px;
            border-radius: 5px;
            box-shadow: 1px 1px 1px black;
        }
        .user-edit button:hover{
            transition: 0.1s;
            box-shadow: 3px 3px 3px black;
        }
        .upload-content{
            background-color: white;
            width: 100%;
            padding: 2px;
            border-radius: 5px;
            margin-bottom: 8px;
}
    </style>
</head>
<body>
    <header class="header-top">
        <h1 style="color: white; padding-left: 12px; padding-bottom: 15px;">AguaThink</h1>
        <nav class="navigation">
            <a href="homePage.php">Home</a>
            <a onclick="openPop()">Add Post</a>
            <a href="weather.html">Weather</a>
            <a href="">Evacuation Site</a>
        </nav>
    </header>
    <div class="container">
        <div class="picture">
        <img class="profile-picture" src="empty.webp" alt="Profile Picture">
        <h1><?php echo htmlspecialchars($user["username"]); ?></h1>
    <div class="user-edit">
            <form method="POST" action="profile.php">
            <label for="username">Edit Username:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user["username"]); ?>">
            <button type="submit" name="update_username">Update</button>
        </form>
        <!-- <p><?php echo htmlspecialchars($user["email"]); ?></p> -->
        <p>Hi, I'm <?php echo htmlspecialchars($user["username"]); ?></p>
    </div>
        
    </div>

    <!-- Post creation modal -->
    <div class="topup" id="popUp" style="display: none;">
        <div class="topup-content">
            <form action="add_post.php" method="post">
                <p><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                <textarea name="content" placeholder="Write a post here." required></textarea><br>
                <button type="submit" name="submit" class="btn">Upload</button>
                <button type="button" class="btn cancel" onclick="closePop()">Cancel</button>
            </form>
        </div>
    </div>

    <h1 style="padding-left: 40px; ">Your Posts</h1>
    <?php if (mysqli_num_rows($post_result) > 0): ?>
        <?php while ($post = mysqli_fetch_assoc($post_result)): ?>
            <div class="upload">
                <p style="font-size: 15px;"><?php echo htmlspecialchars($user["username"]); ?></p>
                <p style="font-size: 10px;"><?php echo date("F j, Y, g:i a", strtotime($post["created_at"])); ?></p>
                <div class="upload-content"><p><?php echo nl2br(htmlspecialchars($post["content"])); ?></p></div>
                
                <!-- Edit button styled as a button, linking to edit_post.php -->
                <form method="GET" action="edit_post.php" style="display:inline;">
                    <input type="hidden" name="post_id" value="<?php echo $post["id"]; ?>">
                    <button type="submit">Edit</button>
                </form>

                <!-- Delete button -->
                <form method="POST" action="delete_post.php" style="display:inline;">
                    <input type="hidden" name="post_id" value="<?php echo $post["id"]; ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No posts available.</p>
    <?php endif; ?>
    <div class="topup" id="popUp" style="display: none;">
        <div class="topup-content">
            <form action="add_post.php" method="post">
                <p><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                <textarea name="content" placeholder="Write a post here." required></textarea><br>
                <button type="submit" name="submit" class="btn" >Upload</button>
                <button type="button" class="btn" onclick="closePop()">Cancel</button>
            </form>
        </div>
    </div>
    <hr width="85%">
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

