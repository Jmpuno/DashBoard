<?php 
include('connection.php');
$profilePicture = $_FILES['profilePic'];


echo '<script type="text/javascript">
    
    document.getElementById("picture").src = '.$profilePicture.';
    
</script>';

mysqli_close($conn);
?>