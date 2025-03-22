
<?php
 include('connection.php');
$uname = $_POST['username'];
$upass = $_POST['userpass'];

//TO VERIFY IF USER INPUT PASS IS MATCH TO HASH PASSWORD FROM DATABASE
function checkPassword($userInputPass, $suid){
    include('connection.php');
    $sql = "SELECT studentPass FROM tbl_studentinfo WHERE student_id = $suid";
    $result = mysqli_query($conn,$sql);
    $hashPass = mysqli_fetch_assoc($result);
    $hashVar = $hashPass['studentPass'];
    if(password_verify($userInputPass, $hashVar)){
        return TRUE;
    }else{
        return FALSE;
    }
}

//TO FETCH SOME DATA AND LOGIN INSIDE DASHBOARD
function fetchData($studentId){
    include('connection.php');
    $sql = "SELECT * FROM tbl_studentinfo WHERE student_id ='$studentId'";
    $result = mysqli_query($conn,$sql);		
        if (mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)) {
                $uid2 = $row['Id'];
                $sid2 = $row['student_Id'];
                $sfname2 = $row['firstname'];
                $slname2 = $row['lastname'];
            } 
                session_start();
                $_SESSION['welcomeMsg'] = "Welcome to My Website";

                $_SESSION['Id'] = $uid2;
                $_SESSION['student_Id'] = $sid2;
                $_SESSION['studentPass'] = $upass;
                $_SESSION['firstname'] = $sfname2;
                $_SESSION['lastname'] = $slname2;
                header('Location: ../model/dashboard.php');

        }
}


if(checkPassword($upass, $uname)){
    //IF USER INPUT PASS IS MATCH TO HASH PASS IN DB IT WILL PROCEED TO LOGIN
    include('connection.php');
    echo '<script type="text/javascript">'; 
    echo 'alert("LOGIN");'; 
    echo '</script>';
    fetchData($uname);
}else{
    // IF IT DIDNT MATCH USER WILL NEED TO TRY AGAIN
        echo '<script type="text/javascript">'; 
    echo 'alert("No User Registered Yet\nUsername or Password is Incorrect!\nPlease Try Again!");'; 
    echo 'window.location.href = "../model/loginPage.html";';
    echo '</script>';
}

mysqli_close($conn);
?>