<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "AguaThink";

// Use the correct variables in the mysqli constructor
$conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
