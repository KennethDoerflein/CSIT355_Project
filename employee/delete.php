<?php
    //gets db connection info
    require_once '../scripts/connectToDatabase.php';
    //gets session info
    session_start();
    if($_SESSION['deleteProduct'] == 'missingInput'){
        $notice = 'Something was missing. Please try again.';
            
        $_SESSION['deleteProduct'] = '';
    } else if ($_SESSION['deleteProduct'] == 'connectionFailed'){
                $notice = 'Please try again later.';
                    
                $_SESSION['deleteProduct'] = '';
    } else if ($_SESSION['deleteProduct'] == 'success'){
                $notice = 'Product was successfully deleted.';
                    
                $_SESSION['deleteProduct'] = '';
    } else if ($_SESSION['deleteProduct'] == 'failed'){
                $notice = 'Product was not deleted. Please try again.';
                    
                $_SESSION['deleteProduct'] = '';
    }
    
    
    if ((isset($_SESSION['active']) && $_SESSION['active']) === false) {
        $_SESSION['loggedin'] = false;
        header('Location: ./login.php');

        //closes db connection
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
        <style>
            body{
                font-size:26px;
                font-family: 'Open Sans';
            }
            a{
                color:black;
            }
            a:hover{
                color: blue;
            }
            .sButton {r
                border: none;
                text-decoration: none;
                background-color: black;
                color: white;
                display: inline-block;
                padding: 15px 70px;
                font-size: 16px;
                text-align: center;
                margin: 10px 0px;
                cursor: pointer;
            }
            input{
                padding: 10px;
                width: 40%;
                margin: 8px 0px;
            }
        </style>
        
        <div class="topnav">
          <a href="./homepage.php">Home</a>
          <a href="products.php">Products</a>
          <a class="right" href="./scripts/logout.php">Logout</a>
          <a class="right" href="./account.php">Account</a>
        </div>
        
        <center>
            <h1><center>Delete a product</center></h1>
            <center><div style='color: red;'><?php echo $notice; ?></div></center>
            <center>Fill the product information below:</center>
            <form action='./scripts/deleteProduct.php' method='post'>
                <div class="login-form" id="login-form">
                    <div><input type="text" name="name" id="name" placeholder="Product ID" required></div>

                    <input name="submit" type="submit" class="sButton" value="Delete Product" id="login-submit">
                </div>
            </form>
        <!--<div>-->
        <!--    <a class="link" href="./insertProduct.php">Add a product</a>-->
        <!--</div>-->
        </center>
    </body>
</html>