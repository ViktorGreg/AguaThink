<?php
session_start();
require_once "database.php";

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Handle post submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $user_id = $_SESSION["user_id"];
    $content = $_POST["content"];

    if (!empty($content)) {
        $sql = "INSERT INTO posts (user_id, content, created_at) VALUES (?, ?, NOW())";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "is", $user_id, $content);
            if (mysqli_stmt_execute($stmt)) {
                header("Location: profile.php");
                exit();
            } else {
                die("Failed to create post: " . mysqli_error($conn));
            }
        } else {
            die("Failed to prepare the statement.");
        }
    } else {
        die("Content cannot be empty.");
    }
}
?>
