<?php 
session_destroy();
echo'<script type="text/javascript">';
echo'alert("Thankyou!");';
echo'window.location.href = "../model/loginPage.html";';
echo'</script>';
session_destroy();
?>