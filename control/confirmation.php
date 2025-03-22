<?php
session_start();
include('connection.php');
$sql = "SELECT * FROM tbl_studentinfo";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $statusId = $_SESSION['Id'];
        $changeStat = $_SESSION['statusVal'];

        switch($changeStat){
            case"1":
                $sql = "UPDATE tbl_studentinfo SET Status = $changeStat WHERE Id  = $statusId";
                break;
            case"0":
                $sql = "UPDATE tbl_studentinfo SET Status = $changeStat WHERE Id  = $statusId";
                break;
            default;
            
        }
        if(isset($sql)&& $conn->query($sql) === TRUE){
            echo '<script type="text/javascript">
                    alert("Status Change Success!");
                    window.location.href = "../model/dashboard.php";
                     </script>';
        }else{
            echo '<script type="text/javascript">
                    alert("Status Change Failed!");
                    window.location.href = "../model/dashboard.php";
                     </script>';
        }
    }
}
mysqli_close($conn);
?>