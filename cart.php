<?php
    // connect to the database
    require_once './scripts/connectToDatabase.php';
        
        // start session
    session_start();
    
    
    if ((isset($_SESSION['active']) && $_SESSION['active']) === false) {
        $_SESSION['loggedin'] = false;
        header('Location: ./index.php');

        //closes db connection
        $database->close();
        exit();
    }
    
    if(isset($_SESSION["active"])){
        if(time()-$_SESSION["login_time_stamp"] > 1800){
            session_unset();
            session_destroy();
            header("Location: ./index.php");
        }
    }
    
    
    
    if($_SESSION['addCart'] == 'added'){
        $notice = 'Item was added to your cart';
            
        $_SESSION['addCart'] = '';
    }else if($_SESSION['addCart'] == 'failed'){
        $notice = 'Item was not added to your cart';
            
        $_SESSION['addCart'] = '';
    }
    else if($_SESSION['addCart'] == 'insuffStock'){
        $notice = 'Insufficent Stock';
            
        $_SESSION['addCart'] = '';
    }else if($_SESSION['removeCart'] == 'removed'){
        $notice = 'Item was removed';
            
        $_SESSION['removeCart'] = '';
    }else if($_SESSION['removeCart'] == 'failed'){
        $notice = 'Item was not removed';
            
        $_SESSION['removeCart'] = '';
    }
    else if($_SESSION['placeOrder'] == 'inSuffStock'){
        $notice = 'Insufficient stock, product quantities were updated';
            
        $_SESSION['placeOrder'] = '';
    }
    else if($_SESSION['placeOrder'] == 'success'){
        $notice = 'Order received';
            
        $_SESSION['placeOrder'] = '';
    }
    $activeUser = $_SESSION['account'];
    //$query = "SELECT * FROM CART WHERE accountNumber ='$activeUser'";
    //$products = $database->query($query);
    //$numOfItemsInCart = mysqli_num_rows($products);
    //$currentProduct = $products->fetch_assoc();
        
    $query = "SELECT PRODUCT.productID, PRODUCT.price, PRODUCT.name, PRODUCT.image, CART.quantity, CART.dateAdded FROM CART INNER JOIN PRODUCT ON PRODUCT.productID = CART.productID WHERE CART.accountNumber = $activeUser ORDER BY dateAdded DESC";    
    $products = $database->query($query);
    $numOfItemsInCart = mysqli_num_rows($products);
    $currentProduct = $products->fetch_assoc();  
    $totalCost = doubleval(0.0);
        
    //closes connection
    $database->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Office Supply Emporium</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    
    <body>

        
        <div class="topnav">
          <a  href="homepage.php">Home</a>
          <a  href="products.php">Products</a>
          <a class="right" href="./scripts/logout.php">Logout</a>
          <a class="right" href="account.php">Account</a>
          <a class="right active" href="cart.php">Cart</a>
          <form action="./searchResults.php" method="post">
              <div class="search-container">
                  <button type="submit">Submit</button>
                  <input type="text" placeholder="Search.." name="search" required>
              </div>
          </form>
        </div>
        <br>
        <center><div style='color: red;'><?php echo $notice; ?></div></center>
        <center><div>Cart</div></center>
        <hr></hr>
        <br>
        <?php
            if($numOfItemsInCart == 0){
                echo "<center>Your cart is empty</center>";
            }else{
                for($i = 0; $i < $numOfItemsInCart ; $i++){
                    echo '<form action="./scripts/removeFromCart.php" method="post">';
                    echo '<div class="cartCard">';
                        echo '<img src="'.$currentProduct['image'].'" style="width:2.5%">';
                        echo '<div class = "cart-info">'.$currentProduct['name'].'</div>';
                        echo '<div class = "cart-info">Price: '.money_format("$%i",$currentProduct['price']).'</div>';
                        echo '<div class = "cart-info">Quantity: '.$currentProduct['quantity'].'</div>';
                        $subTotal = $currentProduct['quantity'] * $currentProduct['price'];
                        echo '<div class = "cart-info">Subtotal: '.money_format("$%i",$subTotal).'</div>';
                        $totalCost += $subTotal;
                        echo' <button class="sButton" name ="productID" value ='.$currentProduct['productID'].'>Remove</button>';
                        echo '<br>';
                        echo '</form>';
                    echo '</div>';
                    $currentProduct = $products->fetch_assoc();
                }
            }
            ?>
            <?php
            if($numOfItemsInCart > 0){
            echo '<center><div>Total Cost: ';
            echo money_format("$%i",$totalCost);
            echo '</div></center>';
            echo '<form action="./checkout.php" method="post">';
            echo' <center><button class="sButton">Checkout</button></center>';
            echo '</form>';
            }
            ?>
    </body>
</html>











