<?php
session_start();
require_once "database.php"; // Include your database connection script

$sql = "SELECT posts.content, posts.created_at, users.username
        FROM posts
        JOIN users ON posts.user_id = users.id
        ORDER BY posts.created_at DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- <link rel="stylesheet" href="homePage.css"> -->
</head>
<style>
    *{
    font-family: Arial, Helvetica, sans-serif;
    }
    body {
        margin: 0;
    }

    .header-top a{
        text-align: center; 
        text-decoration: none;
        font-size: 3em;
        font-weight: bold;
        color: white; 
        cursor: pointer; 
        display: inline; 
        padding-left: 15px;
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
    .navigation a:hover{
        color: black;
        background-color: whitesmoke;
        transition: 0.3s;
        border: none;
    }
    .navigation a{
        padding: 8px;
        z-index: 99;
        background-color: red;
        font-weight: bold;
        width: 25%;
        height: 30px;
        background: transparent;
        border: none;
        font-size: 15px;
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
        height: 1500px;
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
        transition: 0.1s;
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
        padding-left: 23px;
        padding-bottom: 25px;
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
        transition: 0.2s;
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
    #closed{
        cursor: pointer;
        float: right;
    }
    .upload-content{
        background-color: white;
        width: 100%;
        padding: 2px;
        border-radius: 5px;
    }
</style>
<body>
    <header class="header-top">
        <h1 style="font-size: 3em; text-align: center; color: white; cursor: pointer; display: inline; padding-left: 15px;">AguaThink</h1>
        <nav class="navigation">
            <a href="homePage.php">Home</a>
            <!-- <a onclick="openPop()">Add Post</a> -->
            <a href="weather.php">Weather</a>
            <a href="evacuationSite.php">Evacuation Site</a>
        </nav>
    </header>

    <div class="container">
        <nav class="navigation-2">
            <!-- <a href="profile.php"><button>Profile</button></a> -->
            <a href="donationHub.php"><button>Donation Hub</button></a>
            <a href="hotline.php"><button>Hotline</button></a>
            <a href="aboutus.php"><button>About Us</button></a>
            <a href="feedback.php"><button>Feedback</button></a>
            <!-- <a href="login.php" onclick="logalert()"><button>Log out</button></a> -->
            <a href="login.php"><button>Log in as Admin</button></a>
        </nav>

        <div class="contains">
            <?php while ($post = mysqli_fetch_assoc($result)): ?>
                <div class="upload">
                    <p style="font-size: 15px;"><?php echo htmlspecialchars($post["username"]); ?></p>
                    <p style="font-size: 10px;"><?php echo htmlspecialchars($post["created_at"]); ?></p>
                    <div class="upload-content"><p><?php echo htmlspecialchars($post["content"]); ?></p></div>
                </div>
                <hr>
            <?php endwhile; ?>
        </div>
    </div>

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

    <!-- <script>
        function openPop() {
            document.getElementById("popUp").style.display = "flex";
        }

        function closePop() {
            document.getElementById("popUp").style.display = "none";
        }

        function logalert() {
            alert("You are about to exit the home page.");
        }
    </script> -->
    
</body>
</html>
