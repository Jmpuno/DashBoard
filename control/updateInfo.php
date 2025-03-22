<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){

  $updateId = htmlspecialchars($_POST['updt-Id']);
  $studentId = htmlspecialchars($_POST['studentId']);
  $currentPass = htmlspecialchars($_POST['currentPass']);
  $newPass = htmlspecialchars($_POST['newPass']);
  $confirmNewPass = htmlspecialchars($_POST['cNewPass']) ;
  $newAddress = htmlspecialchars($_POST['updt-Add']);
  $newContactNum = htmlspecialchars($_POST['updtContactNum']);
  $newEmergencyNum = htmlspecialchars($_POST['updtEmergencyNum']);
  
  $profilePic = $_FILES['profilePic'];

  include('connection.php');


  $allowedTypes = ['jpg', 'jpeg', 'png'];
  $extractFile = strtolower(pathinfo($profilePic['name'], PATHINFO_EXTENSION));


  function updateProfilePic($file, $id){
    include('connection.php');
    $sql = "UPDATE tbl_studentinfo
    SET profilePic = '$file'
    WHERE Id = $id";


    if ($conn->query($sql) === TRUE) {
      echo '<script type="text/javascript">
      window.location.href = "../model/dashBoard.php";
      alert("Picture Upload Success");
      </script>';
    } else {
    echo '<script type="text/javascript">
    alert("Picture Upload Failed");
    window.location.href = "../model/dashBoard.php"; 
    </script>';
    }    
  }



  

  $infoArray = array($newPass, $newAddress, $newContactNum, $newEmergencyNum);

  switch($infoArray){

    case $infoArray[0] == "" && $confirmNewPass != null || $infoArray[0] != null && $confirmNewPass == "" :
      echo '<script type="text/javascript">
          window.location.href = "../model/dashboard.php";
          alert("Form Error, incomplete form steps in change password");
          </script>'; 
      break; 

    case $infoArray[0] == $currentPass:
      echo '<script type="text/javascript">
          window.location.href = "../model/dashboard.php";
          alert("Password Change Failed! Pls enter a new different Password");
          </script>'; 
      break;  
      
    case $infoArray[0] != $confirmNewPass:
      echo '<script type="text/javascript">
          window.location.href = "../model/dashboard.php";
          alert("Password Change Failed! Pls input same new Password on Confirm New Password");
          </script>'; 
      break;  
        
    default:
      function updateInfo1($col1, $data1 ,$id){
        include('connection.php');
        $sql = "UPDATE tbl_studentinfo
                SET $col1 = '$data1'
                WHERE Id = $id";
          if ($conn->query($sql) === TRUE) {
            echo "Update Success!";
        } else {
          echo '<script type="text/javascript">
          alert("Password and other Information Changes FAILED! Pls try again!");
          window.location.href = "../model/dashBoard.php"; 
          </script>';
        }

    }
    function updateInfo2($col1, $data1, $col2, $data2,$id){
      include('connection.php');
      $sql = "UPDATE tbl_studentinfo
              SET $col1 = '$data1',
                  $col2 = '$data2'
              WHERE Id = $id";
      if ($conn->query($sql) === TRUE) {
        echo "Update Success!";
        } else {
          echo '<script type="text/javascript">
          alert("Password and other Information Changes FAILED! Pls try again!");
          window.location.href = "../model/dashBoard.php"; 
          </script>';;
        }    
          
    }
    function updateInfo3( $col1,$data1, $col2,$data2, $col3,$data3, $id){
      include('connection.php');
      $sql = "UPDATE tbl_studentinfo
              SET $col1 = '$data1',
                  $col2 = '$data2',
                  $col3 = '$data3'     
              WHERE Id = $id";
      if ($conn->query($sql) === TRUE) {
        echo "Update Success!";
        } else {
          echo '<script type="text/javascript">
          alert("Password and other Information Changes FAILED! Pls try again!");
          window.location.href = "../model/dashBoard.php"; 
          </script>';
        }
      
    }
    function updateInfo4($col1,$data1, $col2,$data2, $col3,$data3, $col4,$data4, $id){
      include('connection.php');
      $sql = "UPDATE tbl_studentinfo
              SET $col1 = '$data1',
                  $col2 = '$data2',
                  $col3 = '$data3',
                  $col4 = '$data4'     
              WHERE Id = $id";
        if ($conn->query($sql) === TRUE) {
        echo "Update Success!";
        } else {
        echo '<script type="text/javascript">
          alert("Password and other Information Changes FAILED! Pls try again!");
          window.location.href = "../model/dashBoard.php"; 
          </script>';
        }
      
    }

    switch($infoArray){
      //IF ALL INFO ARE PRESENT:
      case$infoArray[0] != null && $infoArray[1] != null && $infoArray[2] != null && $infoArray[3] != null:
          updateInfo4('studentPass', $newPass, 'homeAdd', $newAddress, 'contact', $newContactNum, 'parentContact', $newEmergencyNum, $updateId);
          echo '<script type="text/javascript">
          alert("Password and other Information Changes Success! Pls Re-Log In");
          window.location.href = "../control/logout.php"; 
          </script>';// everytime we change password, we need to re-login
        
        break;

        // 3 INPUT DATA PATTERNS:
        case$infoArray[0] != null && $infoArray[1] != null && $infoArray[2] != null && $infoArray[3] == null:
          updateInfo3('studentPass', $newPass, 'homeAdd', $newAddress, 'contact', $newContactNum, $updateId);
          echo '<script type="text/javascript">
          alert("Password and other Information Changes Success! Pls Re-Log In");
          window.location.href = "../control/logout.php"; 
          </script>';// everytime we change password, we need to re-login
        break; 
        case$infoArray[0] != null && $infoArray[1] != null && $infoArray[2] == null && $infoArray[3] != null:
          updateInfo3('studentPass', $newPass, 'homeAdd', $newAddress , 'parentContact', $newEmergencyNum, $updateId);
          echo '<script type="text/javascript">
          alert("Password and other Information Changes Success! Pls Re-Log In");
          window.location.href = "../control/logout.php"; 
          </script>';// everytime we change password, we need to re-login
        break; 
        case$infoArray[0] != null && $infoArray[1] == null && $infoArray[2] != null && $infoArray[3] != null:
          updateInfo3('studentPass', $newPass, 'contact', $newContactNum, 'parentContact', $newEmergencyNum, $updateId);
          echo '<script type="text/javascript">
          alert("Password and other Information Changes Success! Pls Re-Log In");
          window.location.href = "../control/logout.php"; 
          </script>';// everytime we change password, we need to re-login
        break;  
        case$infoArray[0] == null && $infoArray[1] != null && $infoArray[2] != null && $infoArray[3] != null:
          updateInfo3('homeAdd', $newAddress, 'contact', $newContactNum, 'parentContact', $newEmergencyNum, $updateId);
          echo '<script type="text/javascript">
          alert("Update Success");
          window.location.href = "../model/dashBoard.php"; 
          </script>';
        break; 

        //2 INPUT DATA PATTERNS:
        case$infoArray[0] != null && $infoArray[1] != null && $infoArray[2] == null && $infoArray[3] == null:
          updateInfo2('studentPass', $newPass, 'homeAdd', $newAddress,$updateId);
          echo '<script type="text/javascript">
          alert("Password and other Information Changes Success! Pls Re-Log In");
          window.location.href = "../control/logout.php"; 
          </script>';// everytime we change password, we need to re-login
        break; 
        case$infoArray[0] != null && $infoArray[1] == null && $infoArray[2] != null && $infoArray[3] == null:
          updateInfo2('studentPass', $newPass, 'contact', $newContactNum, $updateId);
          echo '<script type="text/javascript">
          alert("Password and other Information Changes Success! Pls Re-Log In");
          window.location.href = "../control/logout.php"; 
          </script>';// everytime we change password, we need to re-login
        break; 
        case$infoArray[0] == null && $infoArray[1] != null && $infoArray[2] != null && $infoArray[3] == null:
          updateInfo2( 'homeAdd', $newAddress, 'contact', $newContactNum, $updateId);
        break; 
        case$infoArray[0] != null && $infoArray[1] == null && $infoArray[2] == null && $infoArray[3] != null:
          updateInfo2('studentPass', $newPass,'parentContact', $newEmergencyNum, $updateId);
          echo '<script type="text/javascript">
          alert("Information Changes Success!");
          window.location.href = "../model/dashBoard.php"; 
          </script>';
        break; 
        case$infoArray[0] == null && $infoArray[1] != null && $infoArray[2] == null && $infoArray[3] != null:
          updateInfo2('homeAdd', $newAddress, 'parentContact', $newEmergencyNum, $updateId);
        break; 
        case$infoArray[0] == null && $infoArray[1] == null && $infoArray[2] != null && $infoArray[3] != null:
          updateInfo2('studentPass', $newPass, 'homeAdd', $newAddress, $updateId);
          echo '<script type="text/javascript">
          alert("Information Changes Success!");
          window.location.href = "../model/dashBoard.php"; 
          </script>';
        break;

        //1 INPUT DATA PATTERS:
        case$infoArray[0] != null && $infoArray[1] == null && $infoArray[2] == null && $infoArray[3] == null:
          updateInfo1('studentPass', $newPass, $updateId);
          echo '<script type="text/javascript">
          alert("Password Change Success! Pls Re-Log In");
          window.location.href = "../control/logout.php"; 
          </script>';// everytime we change password, we need to re-login
        break;
        case$infoArray[0] == null && $infoArray[1] != null && $infoArray[2] == null && $infoArray[3] == null:
          updateInfo1('homeAdd', $newAddress,$updateId);
          echo '<script type="text/javascript">
          alert("Address Update Success!");
          window.location.href = "../model/dashBoard.php"; 
          </script>';
        break;
        case$infoArray[0] == null && $infoArray[1] == null && $infoArray[2] != null && $infoArray[3] == null:
          updateInfo1('contact', $newContactNum, $updateId);
          echo '<script type="text/javascript">
          alert("Contact Update Success!");
          window.location.href = "../model/dashBoard.php"; 
          </script>';
        break;
        case$infoArray[0] == null && $infoArray[1] == null && $infoArray[2] == null && $infoArray[3] != null:
          updateInfo1('parentContact', $newEmergencyNum, $updateId);
          echo '<script type="text/javascript">
          alert("Emergency Number Update Success!");
          window.location.href = "../model/dashBoard.php"; 
          </script>';
        break;
      default:
      case$infoArray[0] == null && $infoArray[1] == null && $infoArray[2] == null && $infoArray[3] == null:
        echo '<script type="text/javascript">
          alert("Information Update FAILED! No input from user! Pls try again!");
          window.location.href = "../model/dashBoard.php"; 
          </script>';
        break;
    }

    break;
  }
  if($profilePic != NULL){
    if(in_array($extractFile, $allowedTypes)){
      $picDirectory = $_SERVER['DOCUMENT_ROOT'] . "/matthew/pictures/";
      $newFileName = "student_" . $studentId . "_" . time() . "." . $extractFile;
      $uploadPath = $picDirectory . $newFileName;

      if(move_uploaded_file($profilePic['tmp_name'], $uploadPath)){
        $imageUrl = "http://localhost/matthew/pictures/" . $newFileName;
        updateProfilePic($newFileName, $updateId);
        echo '<script type="text/javascript">
            alert("Update Success");
            window.location.href = "../model/dashBoard.php"; 
            </script>';
      }else {
          echo '<script type="text/javascript">
        alert("Picture Upload Failed");
        window.location.href = "../model/dashBoard.php"; 
        </script>';
      }
    }else{
      echo '<script type="text/javascript">
        alert("Picture Upload Failed! Invalid File Type, Only png, jpeg, and jpg are allowed!");
        window.location.href = "../model/dashBoard.php"; 
        </script>';
    }
  }

 
  

  mysqli_close($conn);
}
?>