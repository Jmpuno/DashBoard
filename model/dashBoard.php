<?php
session_start();
    if(isset($_SESSION['welcomeMsg'])){
        echo '<script type="text/javascript">
        alert("' .$_SESSION['welcomeMsg']. '");
        window.location.href = "../model/dashboard.php";
        </script>'; 
        unset($_SESSION['welcomeMsg']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dbStyle.css">
    <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
    <title>Dashboard</title>
    
</head>
    <body id="body">
        <h1 class="db_title">Admin Dashboard</h1>
    <br>
    <h3 class="welcome_title"><?php echo "WELCOME ".strtoupper($_SESSION['firstname'])." ".strtoupper($_SESSION['lastname']); ?></h3>
   
    <!-- TABLE OF INFORMATION -->
    <div class="table_cont">
        <div class="db_table">
                <div class="theader cell tlc">Student ID</div>
                <div class="theader cell">Student Name</div>
                <div class="theader cell">Course</div>
                <div class="theader cell">Status</div>
                <div class="theader cell trc">Action</div>
            
            
                <?php include('../control/connection.php');
                $sql = "SELECT * FROM tbl_studentinfo";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)) {
                        $uid2 = $row['Id'];
                        $sid2 = $row['student_Id'];
                        $sfname2 = $row['firstname'];
                        $slname2 = $row['lastname'];
                        $scourse2 = $row['course'];
                        $sstatus2 = $row['Status'];
                        $sPass = $row['studentPass'];
                        $sHAdd = $row['homeAdd'];
                        $contact = $row['contact'];
                        $eContact = $row['parentContact'];
                        $sprofilePic = $row['profilePic'];
                    ?>
                    
                        <div class="tbody cell"><?php echo $sid2?></div>
                        <div class="tbody cell"><?php echo strtoupper($sfname2)." ".strtoupper($slname2)?></div>
                        <div class="tbody cell"><?php echo strtoupper($scourse2);?></div>
                        <div class="tbody cell"><?php
                                if($sstatus2 == 1){
                                    echo "Activated";
                                }else{
                                    echo"Deactivated";
                                }
            
                        ?></div>   
                        <div class="tbody cell">
                            <?php
                                if($sstatus2 == 1){
            
                                    ?>
                                        <button type="button" class="dAct-status-btn btn"  name="changeStats" data-value="<?php echo $uid2;?>">Deactivate now?</button>
                                        <?php
            
            
                                    }else{
                                        ?>
            
                                        <button type="button" class="act-status-btn btn" name="changeStats" data-value="<?php echo $uid2;?>">Activate now?</button>
                                        <?php
                                    }
            
            
                            ?>
                            <button class="updt-btn btn" data-value="<?php echo $uid2;?>" data-studentid="<?php echo $sid2;?>" data-studentname="<?php echo $sfname2." ". $slname2;?>" data-currpass = "<?php echo $sPass;?>"; data-homeadd ="<?php echo $sHAdd;?>"; data-contact= "<?php echo $contact;?>"; data-emergencynum = "<?php echo $eContact;?>"; data-profilePic = "<?php echo $sprofilePic;?>";  name="updt-Id" >Update</button>
                        </div>
                
                        <?php
                    }
                }
                mysqli_close($conn);
                ?>
           
        </div>
    </div>


   
    <form action="../control/logout.php">
    <button type="submit" class="submit-btn btn">LOG-OUT</button>
    </form>
    </body>
</html>

<!-- JQUERY SCRIPT: -->
<script>
$(document).on("click", ".dAct-status-btn", function(){
    var userId = $(this).data("value"); //GET BTN VALUE
    $("#row-id0").val(userId);//SET VALUE TO FORM
} );

//FOR ACTIVATE BUTTON
$(document).on("click", ".act-status-btn", function(){
    var userId = $(this).data("value");
    $("#row-id1").val(userId);
} );

// FOR UPDATE BUTTON
$(document).on("click", ".updt-btn", function(){
    var userId = $(this).data("value");
    $("#updt-Id").val(userId);
} );
</script>


<!-- STATUS MODAL: -->
<div id="status-mod">     
            <!-- DEACTIVATION MODAL: -->
            <div id="deactivation_mod" class="deactivation-mod">
                <form action="../control/updateStatus.php" method="post">
                <input type="hidden" name="row-id0" id="row-id0" value="">
                <input type="hidden" name="changeStats" id="changeStats" value="0">
                <button  type="button" class="close1-btn">X</button>
                <p class="actionQ">Do you want to DEACTIVATE status?</p>
                <button type="submit" class="yes-btn" >Yes</button>
                <button type="button" class="no-btn">No</button>
                </form>
                
            
            </div>
           

            <!-- ACTIVATION MODAL: -->
            <div id="activation_mod" class="activation-mod">
                <form action="../control/updateStatus.php" method="post">
                <input type="hidden" name="row-id1" id="row-id1" value="">
                <input type="hidden" name="changeStats" id="changeStats" value="1">
                <button type="button" class="close2-btn">X</button>
                <p class="actionQ">Do you want to ACTIVATE status?</p>
                <button type="submit" class="yes-btn">Yes</button>
                <button type="button" class="no-btn">No</button>
                </form>
            </div>
    </div>

   
    <!-- UPDATE MODAL -->
    <div id="updt-cont">
    <div class="updt-mod" id="updt_mod">
        <form action="../control/updateInfo.php" method="post" enctype="multipart/form-data">
            <button type="button" class="close3-btn">X</button>
            <input type="hidden" name="updt-Id" id="updt-Id" value="">
            <h4>Update Information For Student: <div class="update-sid"><span id="modalStudentID"></span></div><div class="update-sname"><span id="modalStudentName"></span></div></h4>



        <!-- PROFILE PICTURE: -->
            <h2>Profile Picture</h2>
            <input type="hidden" name="studentId" id="studentId" value="">
            <input type="file" name="profilePic" id="profilePic" accept="image/*" >
            <h3>Profile:</h3>
            <div class="pic-cont">
            <img id="picture" src="pictures/default.png" alt="Profile Image" style="height: 15%; width: 15%; border-radius: 50px; ">
            </div>
            


            <h3>Change Password</h3>

            <label for="newPass">Enter New Passsword: </label>
            <input type="password" name="newPass" id="newPass" placeholder="New Password" min="3"><br><br>
            <label for="cNewPass">Confirm New Passsword: </label> 
            <input type="password" name="cNewPass" id="cNewPass" placeholder="Confirm Password" min="3">
            <h3>Update Address</h3>
            <textarea name="updt-Add" id="updt-Add" placeholder="Enter a New Address" value=""></textarea>
            <h3>Update Contact Number</h3>
            <label for="updtContactNum">Update Contact Number: </label>
            <input type="number" name="updtContactNum" id="updtContactNum" placeholder="Enter New Contact Number" value="" maxlength="11"><br><br>
            <label for="updtEmergencyNum">Update Emergency Number:  </label>
            <input type="number" name="updtEmergencyNum" id="updtEmergencyNum" placeholder="Enter New Emergency Number" value=""maxlength="11"><br><br>
            <button type="submit" class="continue-btn">Confirm Changes</button>
            <button type="button" class="cancelUpdt-Btn">Cancel</button>
        </form>
    </div>
    </div>
    <script src="dbScript.js"></script>