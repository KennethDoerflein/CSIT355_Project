<?php
    // connect to the database
    require_once '../scripts/connectToDatabase.php';
        
        // start session
    session_start();
    
    if ((isset($_SESSION['active']) && $_SESSION['active']) === false) {
        $_SESSION['loggedin'] = false;
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
        <link rel="stylesheet" href="../style.css">
    </head>
    
    <body>
        <div class="topnav">
          <a class="active" href="./homepage.php">Home</a>
          <a class="right" href="./scripts/logout.php">Logout</a>
          <a class="right" href="./account.php">Account</a>
        </div>
        
        Homepage
        <br>
        <?php
            echo "Account Number of Person Logged in: " .$_SESSION['account'] ;
        ?>
        <div>
            <a class="link" href="./insert.php">Add a product</a>
        </div>
        <div>
            <a class="link" href="./delete.php">Delete a product</a>
        </div>
        <div>
            <a class="link" href="./modify.php">Modify a product</a>
        </div>
    </body>
</html>