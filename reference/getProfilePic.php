<?php
include('../control/connection.php');

header('Content-Type: application/json');

// Query to get the latest profile picture from the database
$stmt = $conn->prepare("SELECT profilePic FROM tbl_studentinfo ORDER BY id DESC LIMIT 1");
$stmt->execute();
$stmt->bind_result($profilePic);
$stmt->fetch();
$stmt->close();

// Check if a profile picture exists, otherwise return default
$response = [
    "status" => "success",
    "profilePic" => $profilePic ? "http://localhost/matthew/pictures/" . $profilePic : "http://localhost/matthew/pictures/default.png"
];

echo json_encode($response);
?>
