<?php

include('../control/connection.php');
$sql = "SELECT * FROM tbl_studentinfo";
$result = mysqli_query($conn, $sql);		
	
mysqli_close($conn);

?>