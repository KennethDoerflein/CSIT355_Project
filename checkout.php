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
    $activeUser = $_SESSION['account'];
    //$query = "SELECT * FROM CART WHERE accountNumber ='$activeUser'";
    //$products = $database->query($query);
    //$numOfItemsInCart = mysqli_num_rows($products);
    //$currentProduct = $products->fetch_assoc();
        
    $query = "SELECT PRODUCT.productID, PRODUCT.price, PRODUCT.name, PRODUCT.image, CART.quantity FROM CART INNER JOIN PRODUCT ON PRODUCT.productID = CART.productID WHERE CART.accountNumber = $activeUser";    
    $products = $database->query($query);
    $numOfItemsInCart = mysqli_num_rows($products);
    $currentProduct = $products->fetch_assoc();  
    $totalCost = doubleval(0.0);
    
    $query ="SELECT * FROM CUSTOMER WHERE accountNumber ='$activeUser'";
    $account = $database->query($query);
    $accountInfo = $account->fetch_assoc();
        
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
          <a class="right" href="cart.php">Cart</a>
          <form action="./searchResults.php" method="post">
              <div class="search-container">
                  <button type="submit">Submit</button>
                  <input type="text" placeholder="Search.." name="search" required>
              </div>
          </form>
        </div>
        <br>
        <center><div style='color: red;'><?php echo $notice; ?></div></center>

        <?php
            echo '<div class="checkoutCard">';
            echo '<u>';
            echo 'Shipping Address';
            echo '</u>';
            echo '<br>';
            echo $accountInfo['Fname'].' '.$accountInfo['Lname'];
            echo '<br>';
            echo $accountInfo['address'];
            echo '<br>';
            echo $accountInfo['phoneNumber'];
            
            echo '</div>';
            echo '<hr>';
            for($i = 0; $i < $numOfItemsInCart ; $i++){
                echo '<div class="cartCard">';
                    echo '<img src="'.$currentProduct['image'].'" style="width:2.5%">';
                    echo '<div class = "cart-info">'.$currentProduct['name'].'</div>';
                    echo '<div class = "cart-info">Price: $'.$currentProduct['price'].'</div>';
                    echo '<div class = "cart-info">Quantity: '.$currentProduct['quantity'].'</div>';
                    $subTotal = $currentProduct['quantity'] * $currentProduct['price'];
                    echo '<div class = "cart-info">Subtotal: '.money_format("$%i",$subTotal).'</div>';
                    $totalCost += $subTotal;
                    echo '<br>';
                echo '</div>';
                $currentProduct = $products->fetch_assoc();
                
            }
            ?>
            <?php
            if($numOfItemsInCart > 0){
            echo '<center><div>Shipping: $0.00</div></center>';
            echo '<center><div>Tax: $0.00</div></center>';
            echo '<center><div>Total Cost: ';
            echo money_format("$%i",$totalCost);
            echo '</div></center>';
            echo '<form action="./scripts/placeOrder.php" method="post">';
            echo '<center><button class="sButton">Place Order</button></center>';
            echo '</form>';
            }
            ?>
    </body>
</html>











