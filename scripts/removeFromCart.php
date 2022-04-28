<?php
    // connect to the database
    require_once './connectToDatabase.php';
    
    // start session
    session_start();
    
    
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