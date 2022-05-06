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
    
    
    $cartID = mt_rand(30000000,40000000);
    $productID = trim($_POST['productID']);
    $quantity = trim($_POST['qty']);
    $acctNum = $_SESSION['account'];
    date_default_timezone_set("America/New_York");
    $date = date("Y/m/d H:i:s");
    
    if(!$productID || !$quantity){
        $_SESSION['addCart'] = 'MissingInput';
        header('Location: javascript:history.back()');
        $database->close();
        exit();
    }
    
    if(!get_magic_quotes_gpc()) {
        $productID = addslashes($productID);
        $quantity = addslashes($quantity);
    }
    
    $query = "SELECT cartID FROM CART";
    $carts = $database->query($query);

    for($i = 0; $i < mysqli_num_rows($carts); $i++){
        $usersCart = $carts->fetch_assoc();
        if($cartID == $usersCart['cartID']){
            $cartID = mt_rand(30000000,40000000);
            $i = 0;
        }
    }
    
    $query = "SELECT * FROM CART WHERE productID ='$productID' AND accountNumber ='$acctNum'";
    $inCart = $database->query($query);
    $numOfItems = mysqli_num_rows($inCart);
    $currentEntry = $inCart->fetch_assoc();
    $currentQTY = $currentEntry['quantity'];
    $newQTY = $currentQTY + $quantity;
    if( $numOfItems > 0 ){
        $quantity = $newQTY;
    }
    
    $query = "SELECT * FROM PRODUCT WHERE productID ='$productID'";
    $product = $database->query($query);
    $productsInfo = $product->fetch_assoc();
    
    if ($productsInfo['quantity'] < $quantity){
        $_SESSION['addCart'] = 'insuffStock';
        header('Location: ../cart.php');
        $database->close();
        exit();
    }else if($numOfItems > 0){
        $inputToCart = "UPDATE CART SET quantity = '$quantity' WHERE productID ='$productID' AND accountNumber ='$acctNum'";
    }else{
        $inputToCart = "INSERT INTO CART VALUES ('".$cartID."', '".$acctNum."', '".$productID."', '".$quantity."' , '".$date."')";
    }
     $insert = $database->query($inputToCart);
     
     if($insert){
         $_SESSION['addCart'] = 'added';
        header('Location: ../cart.php');
        exit();
     }else{
          $_SESSION['addCart'] = 'failed';
	    header('Location: ../cart.php');
	    exit();
     }
     
     
    // closes connection to database
    $database->close();
?>