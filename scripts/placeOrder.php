<?php
    // connect to the database
    require_once './connectToDatabase.php';
    
    // start session
    session_start();
    
    
    $orderID = mt_rand(500001,900000);
    $id= mt_rand(100000,500000);
    $acctNum = $_SESSION['account'];
    date_default_timezone_set("America/New_York");
    $date = date("Y/m/d H:i:s");
    
    
    $query = "SELECT * FROM CART WHERE accountNumber ='$acctNum'";
    $inCart = $database->query($query);
    $numOfItems = mysqli_num_rows($inCart);
    $currentEntry = $inCart->fetch_assoc();
    $insuffStock = false;
    for($i = 0; $i < $numOfItems; $i++){
        $item = $currentEntry['productID'];
        $query = "SELECT * FROM PRODUCT WHERE productID = $item";
        $product = $database->query($query);
        $productsInfo = $product->fetch_assoc();
        if ($currentEntry['quantity'] > $productsInfo['quantity']){
            $maxQ = $productsInfo['quantity'];
            $inputToCart = "UPDATE CART SET quantity = '$maxQ' WHERE productID ='$item' AND accountNumber ='$acctNum'";
            $insert = $database->query($inputToCart);
            $insuffStock = true;
        }
        $currentEntry = $inCart->fetch_assoc();
    }
    if($insuffStock){
         $_SESSION['placeOrder'] = 'inSuffStock';
        header('Location: ../cart.php');
        exit();
    }
    
    $query = "SELECT * FROM CART WHERE accountNumber ='$acctNum'";
    $inCart = $database->query($query);
    $numOfItems = mysqli_num_rows($inCart);
    $currentEntry = $inCart->fetch_assoc();
    for($i = 0; $i < $numOfItems; $i++){
        $item = $currentEntry['productID'];
        $qty = $currentEntry['quantity'];
        
        $tQuery = "SELECT price, quantity FROM PRODUCT WHERE productID = $item";
        $productPriceItem = $database->query($tQuery);
        $currentPrice = $productPriceItem->fetch_assoc();
        $price = $currentPrice['price'];
        $inputToOrders = "INSERT INTO ORDERS VALUES ('".$id."', '".$acctNum."', '".$orderID."', '".$item."', '".$price."', '".$qty."' , '".$date."')";
        $insert = $database->query($inputToOrders);
        $newQTY = $currentPrice['quantity'] - $qty;
        $updateInventory = "UPDATE PRODUCT SET quantity = '$newQTY' WHERE productID ='$item'";
        $database->query($updateInventory);
        $itemInCart = $currentEntry['cartID'];
        // if (!$insert){
        //     $inputFailed = "DELETE FROM ORDERS WHERE orderNumber = $orderID";
        //     $database->query($inputFailed);
        //     $_SESSION['placeOrder'] = 'err';
        //     header('Location: ../cart.php');
        //     exit();
        // }
        $id = mt_rand(100000,500000);
        $currentEntry = $inCart->fetch_assoc();
    }
    $updateCart = "DELETE FROM CART WHERE accountNumber ='$acctNum'";
    $deleteCart = $database->query($updateCart);
    if($deleteCart){
        $_SESSION['placeOrder'] = 'success';
            header('Location: ../cart.php');
            exit();
    }else{
        $_SESSION['placeOrder'] = 'err';
            header('Location: ../cart.php');
            exit();
    }
    
    // closes connection to database
    $database->close();
?>








