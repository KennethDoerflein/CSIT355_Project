<?php
    // connect to the database
    require_once '../scripts/connectToDatabase.php';
        
        // start session
    session_start();

    if ((isset($_SESSION['active']) && $_SESSION['active']) === false) {
        $_SESSION['loggedin'] = false;
        header('Location: ./login.php');

        //closes database connection
        $database->close();
        exit();
    }
        if(isset($_SESSION["active"])){
        if(time()-$_SESSION["login_time_stamp"] > 1800){
            session_unset();
            session_destroy();
            header("Location: ./login.php");
        }
    }
    
    ## Start - stop CUSTOMER from viewing page
    $customerTest = "SELECT accountNumber FROM CUSTOMER WHERE accountNumber = '".$_SESSION['account']."'";
    //gets info from database
    $isCust = $database->query($customerTest);
    $num_Cust = $isCust->num_rows;
    if ($num_Cust > 0){
        header('Location: ../homepage.php');

        //closes database connection
        $database->close();
        exit();
    }
    ## End - stop CUSTOMER from viewing page

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
          <a class = "active" href="./homepage.php">Home</a>
          <a href="products.php">Products</a>
          <a class="right" href="./scripts/logout.php">Logout</a>
          <a class="right" href="./account.php">Account</a>
        </div>
        
        <br>
        <br>
        <?php
            //echo "Account Number of Person Logged in: " .$_SESSION['account'] ;
        ?>
        <center>
            Employee Tools
            <hr>
        <div>
            <a class="link" href="./insert.php">Add a product</a>
        </div>
        <div>
            <a class="link" href="./delete.php">Delete a product</a>
        </div>
        <div>
            <a class="link" href="./modify.php">Modify a product</a>
        </div>
        </center>
    </body>
</html>