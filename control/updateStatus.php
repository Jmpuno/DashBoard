
<?php

include('connection.php');
    $changeStat = $_POST['changeStats'];
    switch($changeStat){
        case"1":
            $statusId1 = $_POST['row-id1'];
            $sql = "UPDATE tbl_studentinfo SET Status = $changeStat WHERE Id  = $statusId1";
            break;
        case"0":
            $statusId0 = $_POST['row-id0'];
            $sql = "UPDATE tbl_studentinfo SET Status = $changeStat WHERE Id  = $statusId0";
            break;
        default:

            break;
        
    }
    if(isset($sql)&& $conn->query($sql) === TRUE){
        echo '<script type="text/javascript">
                alert("Status Change Success!");
                window.location.href = "../model/dashboard.php";
                </script>';
    }else{
        // echo '<script type="text/javascript">
        //         alert("Status Change Failed!");
        //         window.location.href = "../model/dashboard.php";
        //          </script>';
    }
    mysqli_close($conn);
?>
