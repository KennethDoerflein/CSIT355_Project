<?php
    //gets database connection info
    require_once '../scripts/connectToDatabase.php';
    //gets session info
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
    
    if($_SESSION['modifyProduct'] == 'missingInput'){
        $notice = 'Something was missing. Please try again.';
            
        $_SESSION['modifyProduct'] = '';
    } else if ($_SESSION['modifyProduct'] == 'connectionFailed'){
                $notice = 'Please try again later.';
                    
                $_SESSION['modifyProduct'] = '';
    } else if ($_SESSION['modifyProduct'] == 'success'){
                $notice = 'Product was successfully modified.';
                    
                $_SESSION['modifyProduct'] = '';
    } else if ($_SESSION['modifyProduct'] == 'failed'){
                $notice = 'Product was not modified. Please try again.';
                    
                $_SESSION['modifyProduct'] = '';
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
            <h1><center>Modify a product</center></h1>
            <center><div style='color: red;'><?php echo $notice; ?></div></center>
            <center>Only fill in the product information you want to change below:</center>
            <form action='./scripts/modifyProduct.php' method='post'>
                <div class="login-form" id="login-form">
                    
                    <div><input type="text" name="productID" id="productID" placeholder="Product ID of Item You Want To Modify" required></div>
                    
                    <div><input type="text" name="name" id="name" placeholder="Product Name/Title" ></div>
                    
                    <div><input type="text" name="category" id="category" placeholder="Product Category" ></div>

                    <div><input type="number" step="0.01" name="price" id="price" placeholder="Product Price" ></div>

                    <div><input type="text" name="manufacturer" id="manufacturer" placeholder="Product Manufacturer" ></div>

                    <div><input type="text" name="description" id="description" placeholder="Product Description" ></div>

                    <div><input type="text" name="quantity" id="quantity" placeholder="Product Quantity" ></div>

                    <div><input type="text" name="image" id="image" placeholder="Product Image Link" ></div>

                    <input name="submit" type="submit" class="sButton" value="Modify Product" id="login-submit">
                </div>
            </form>
        <!--<div>-->
        <!--    <a class="link" href="./modifyProduct.php">Add a product</a>-->
        <!--</div>-->
        </center>
    </body>
</html>