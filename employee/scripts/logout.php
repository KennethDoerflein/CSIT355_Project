<?php
    session_start();
    
    session_unset();
    
    session_destroy();
    
    $_SESSION['logout'] = true;
    header('Location: ../login.php');
    exit();
?>