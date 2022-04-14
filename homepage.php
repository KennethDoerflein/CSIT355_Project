<?php
    // connect to the database
    require_once './scripts/connectToDatabase.php';
        
        // start session
    session_start();
    if ((isset($_SESSION['active']) && $_SESSION['active']) === false) {
        $_SESSION['loggedin'] = true;
        header('Location: ./index.php');

        //closes db connection
        $database->close();
        exit();
    }
    
    //closes connection
    $database->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Office Supply Emporium</title>
    </head>
    
    <body>
        <style>
            body{
                font-size:26px;
                font-family: 'Open Sans';
            }
        </style>
        Homepage
        <br>
        <?php
            echo "Account Number of Person Logged in: ".$_SESSION['account'] ;
        ?>
    </body>
</html>