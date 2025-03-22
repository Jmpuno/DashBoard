<?php 

if (isset($_POST['data'])){
    include('connection.php');
    $key = $_POST['data'];
    $sql = "SELECT student_Id FROM tbl_studentinfo WHERE Id = '$key'";
    $result = mysqli_query($conn, $sql);
    $resSId = mysqli_fetch_assoc($result);
    
    echo $resSId;
   

} else{
    echo "No value passed in";
}




?>