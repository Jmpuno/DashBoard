<?php 

$studentId = $_POST['std-Id'];
$firstName = $_POST['fName'];
$lastName = $_POST['lName'];
$course = $_POST['course'];
$homeAddress = $_POST['hAdd'];
$contactNumber = $_POST['cNum'];
$birthDay = $_POST['bDay'];
$sex = $_POST['sex'];
$parentName = $_POST['pName'];
$parentContact = $_POST['pCNum'];
$userPass = $_POST['uPass'];
$confirmPass = $_POST['uCPass'];

$bYear = date($birthDay);
$bMonth = date($birthDay);
$bDay = date($birthDay);
(int) $month1 = date('m', strtotime($bMonth));
(int) $month2 = date("m");
(int) $day1 = date('d', strtotime($bDay));
(int) $day2 = date('d');
$year1 = date('Y', strtotime($bYear));
$year2 = date("Y");

$age = (int)$year2 - (int)$year1 ;

if($month1 > $month2 || $day1 > $day2){
    $age--; 
}

if($age >= 18){
    if($userPass == $confirmPass){
        include('connection.php');
        $hash = password_hash($userPass, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO tbl_studentinfo (student_Id, firstname, lastname, course, homeAdd, contact, birthday, age, sex, parentName, parentContact,studentPass, Status)
        VALUES ('$studentId', '$firstName', '$lastName', '$course', '$homeAddress', '$contactNumber', '$birthDay','$age', '$sex', '$parentName', '$parentContact', '$hash',1)";
        
        if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
          echo '<script type="text/javascript">
        window.location.href = "../model/loginPage.html";
        alert("Registration Complete! Pls Log in your account!");
        </script>'; 
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
    
        mysqli_close($conn);
    }else{
        echo "password and confirm password do not match, pls try again!";
    }
}else{
    echo "process failed! student is not in legal age";
}


?>