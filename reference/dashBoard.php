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
    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- jQuery and Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Dashboard</title>
</head>
<body id="body">

        <h1>My Website</h1>
    <br>
    <h3><?php echo "WELCOME ".strtoupper($_SESSION['firstname'])." ".strtoupper($_SESSION['lastname']); ?></h3>
   
    <table>
        <thead>
            <td>Student ID</td>
            <td>Student Name</td>
            <td>Course</td>
            <td>Status</td>
            <td>Action</td>
        </thead>
        <tbody>
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
             ?>
             <tr>
                <td><?php echo $sid2?></td>
                <td><?php echo strtoupper($sfname2)." ".strtoupper($slname2)?></td>
                <td><?php echo strtoupper($scourse2);?></td>
                <td><?php 
                        if($sstatus2 == 1){
                            echo "Activated";
                        }else{
                            echo"Deactivated";
                        }
                
                ?></td>
                <td>

                    <?php 
                         if($sstatus2 == 1){
                            
                            ?>  
                                <button type="submit" class="dAct-status-btn" style="color: red;" data-bs-toggle="modal" data-bs-target="#deactivateModalForm">Deactivate now?</button>
                                <?php
                            }else{
                                ?>
                                <!-- <input type="text" value="<?php echo $sid2;?>" /> -->
                                    <button type="button" class="btn btn-success activate-btn" data-bs-toggle="modal" data-bs-target="#activateModalForm" data-value="<?php echo $sid2;?>">
                                    Activate User
                                    </button>

                                <?php
                            }
                    
                    ?>
                    
                </td>
                <td>
                    
                    <button type="submit" class="updt-btn" style="color: green;" data-bs-toggle="modal" data-bs-target="#exampleModalForm">Update</button>
                  
                </td>
                 </tr>
             <?php   
            }
        }
        mysqli_close($conn);
        ?>
        
            
        </tbody>
    </table>
    <nav>Order</nav>
    <form action="../control/logout.php">
    <button type="submit" class="submit-btn">LOG-OUT</button>
    </form>
    </body>
    <script src="dbScript.js"></script>


    <script>
$(document).on("click", ".activate-btn", function() {
    var userValue = $(this).data("value"); // Get value from button
    $("#usersetValue").val(userValue); // Set it in the form
});

</script>
</html>

<!-- MODAL HERE -->
<!-- Activate User Account Form Modal -->
<div class="modal fade" id="activateModalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalFormTitle">Activate System User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="../control/updateStatus.php" method="post">
        <div class="modal-body"> 

             <!-- Form properly wrapping the submit button -->
            
            <input type="hidden" name="userset" id="usersetValue" value="">
            <input type="hidden" name="changeStats" id="changeStats" value="1">
                <h5>Do you really want to ACTIVATE this user?</h5>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">NO</button>
                <button type="submit" class="btn btn-primary btn-pill">YES</button>
            </div>

      </div>
      </form>

    </div>
  </div>
</div>

