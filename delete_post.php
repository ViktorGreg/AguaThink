<?php
session_start();
require_once "database.php";

if (!isset($_SESSION["user_id"]) || !isset($_POST["post_id"])) {
    header("Location: profile.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$post_id = $_POST["post_id"];


$sql = "SELECT * FROM posts WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $post_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$post = mysqli_fetch_assoc($result);

if ($post) {
    // Delete the post if it exists and is owned by the user
    $delete_sql = "DELETE FROM posts WHERE id = ?";
    $delete_stmt = mysqli_prepare($conn, $delete_sql);
    mysqli_stmt_bind_param($delete_stmt, "i", $post_id);

    if (mysqli_stmt_execute($delete_stmt)) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Error deleting post: " . mysqli_error($conn);
    }
} else {
    header("Location: profile.php");
    exit();
}
?>
