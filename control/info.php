<?php

$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$haddress = $_POST['homeadd'];
$contactNumber = $_POST['cnum'];
$upass = $_POST['userpass'];
$ucpass = $_POST['usercpass'];

//echo ($firstname)." ".($lastname)."<br/>";
//echo ($address)."<br/>";
//echo ($contactNumber)."<br/>";
//echo ($upass)."<br/>";
//echo ($ucpass)."<br/>";
if($upass == $ucpass){
    include('connection.php');

    $sql = "INSERT INTO tbl_info (fname, lname, hadd, usercont, userpass)
    VALUES ('$firstname', '$lastname', '$haddress', '$contactNumber', '$upass')";
    
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    mysqli_close($conn);
    
} else{
    echo "Password and Confirm password did not match. Please try again!";
}


?>