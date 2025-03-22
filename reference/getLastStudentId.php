<?php
include('../control/connection.php');

$query = "SELECT id FROM tbl_studentinfo ORDER BY id DESC LIMIT 1";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(["student_id" => $row['id']]);
} else {
    echo json_encode(["student_id" => null]);
}
?>
