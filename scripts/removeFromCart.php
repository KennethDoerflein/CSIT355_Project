<?php
    // connect to the database
    require_once './connectToDatabase.php';
    
    // start session
    session_start();
    
    
    if ((isset($_SESSION['active']) && $_SESSION['active']) === false) {
        $_SESSION['loggedin'] = false;
        header('Location: ../index.php');

        //closes database connection
        $database->close();
        exit();
    }
    
    if(isset($_SESSION["active"])){
        if(time()-$_SESSION["login_time_stamp"] > 1800){
            session_unset();
            session_destroy();
            header("Location: ../index.php");
        }
    }
    
    
    $productID = trim($_POST['productID']);
    $acctNum = $_SESSION['account'];


    
    if(!$productID){
        $_SESSION['addCart'] = 'MissingInput';
        header('Location: ./cart.php');
        $database->close();
        exit();
    }
    
    if(!get_magic_quotes_gpc()) {
        $productID = addslashes($productID);
    }
    
    
    if ($productsInfo['quantity'] < $quantity){
        $_SESSION['addCart'] = 'insuffStock';
        header('Location: ../cart.php');
        $database->close();
        exit();
    }else{
        $removeFromCart = "DELETE FROM CART WHERE productID = '$productID' AND accountNUmber = '$acctNum'";
    }
     $remove = $database->query($removeFromCart);
     
     if($remove){
         $_SESSION['removeCart'] = 'removed';
        header('Location: ../cart.php');
        exit();
     }else{
          $_SESSION['removeCart'] = 'failed';
	    header('Location: ../cart.php');
	    exit();
     }
     
     
    // closes connection to database
    $database->close();
?>