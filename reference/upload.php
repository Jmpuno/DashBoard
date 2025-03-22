<?php
include('../control/connection.php');

$response = ["status" => "error", "message" => "Something went wrong."];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['profilePic']) && isset($_POST['student_id'])) {
        $student_id = intval($_POST['student_id']); // Get student ID
        $file = $_FILES['profilePic'];

        // Allowed file types
        $allowedTypes = ['jpg', 'jpeg', 'png'];
        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExt, $allowedTypes)) {
            $response["message"] = "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
        } else {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/matthew/pictures/"; // Correct directory
            $newFileName = "student_" . $student_id . "_" . time() . "." . $fileExt;
            $uploadPath = $uploadDir . $newFileName;

            
            // Move file to the designated folder
            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                $imageUrl = "http://localhost/matthew/pictures/" . $newFileName; // URL for access

                // Update database with new image filename
                $stmt = $conn->prepare("UPDATE tbl_studentinfo SET profilePic = ? WHERE id = ?");
                $stmt->bind_param("si", $newFileName, $student_id);

                if ($stmt->execute()) {
                    $response["status"] = "success";
                    $response["message"] = "Profile picture uploaded successfully!";
                    $response["image_url"] = $imageUrl; // Return image URL
                } else {
                    $response["message"] = "Database update failed.";
                }

                $stmt->close();
            } else {
                $response["message"] = "File upload failed.";
            }
        }
    } else {
        $response["message"] = "Missing student ID or file.";
    }
}

echo json_encode($response);
?>
