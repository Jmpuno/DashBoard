<?php
$fname = $_POST['fName'];
include('connection.php');
$sql = "SELECT studentPass FROM tbl_studentinfo WHERE Id = 4";
$result = mysqli_query($conn,$sql);		
$hashpass = mysqli_fetch_assoc($result);
$hashCont = $hashpass['studentPass'];


if(!password_verify($fname, $hashCont)){
    echo "TRUE";
}else{
    echo "FALSE";
}

mysqli_close($conn);




// function inputCheck($fName, $lName){
//     include('connection.php');
//     if ($fName != null  && $lName != null){
//         $sql = "UPDATE tbl_studentinfo SET firstname = '$fName' WHERE Id = 1";
//     }else if($lName != null){
//         $sql = "UPDATE tbl_studentinfo SET lastname = '$lName' WHERE Id = 1";
//     }else if($fName != null){
//         $sql = "UPDATE tbl_studentinfo SET firstname = '$fName', lastname = '$lName' WHERE Id = 1";
//     }
//     if ($conn->query($sql) === TRUE) {
//         echo "Update Success!";
//     } else {
//         echo "failed";
//     }
    
//     mysqli_close($conn);
// }

// inputCheck($firstname, $lastname);





    // if($data[0] != null){
    //     $sql = "UPDATE tbl_studentinfo
    //     SET firstname = '$firstname'
    //     WHERE Id = 1";
        
            // if ($conn->query($sql) === TRUE) {
            //     echo "Update Success!";
            // } else {
            //     echo "failed";
            // }
    // }

    // if($data[1] != null){
        
    //      $sql1 = "UPDATE tbl_studentinfo SET lastname = '$lastname WHERE Id = 1";
    //     // if ($conn->query($sql1) === TRUE) {
    //     //     echo "Update Success!";
    //     // } else {
    //     //     echo "failed";
    //     // }
    // }














?>
