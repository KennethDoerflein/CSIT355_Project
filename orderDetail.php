<?php
    // connect to the database
    require_once './scripts/connectToDatabase.php';
        
        // start session
    session_start();
    
    if ((isset($_SESSION['active']) && $_SESSION['active']) === false) {
        $_SESSION['loggedin'] = false;
        header('Location: ./index.php');

        //closes database connection
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
    
    ## Start - stop employee from viewing page
    $employeeTest = "SELECT employeeID FROM EMPLOYEE WHERE employeeID = '".$_SESSION['account']."'";
    //gets info from database
    $isEMP = $database->query($employeeTest);
    $num_EMP = $isEMP->num_rows;
    if ($num_EMP > 0){
        header('Location: ./employee/homepage.php');

        //closes database connection
        $database->close();
        exit();
    }
    ## End - stop employee from viewing page
    
    $productID = trim($_POST['productID']);
    if(!get_magic_quotes_gpc()) {
        $productID = addslashes($productID);
    }
    
    $query = "SELECT PRODUCT.productID, ORDERS.price, PRODUCT.name, PRODUCT.image, ORDERS.quantity FROM ORDERS INNER JOIN PRODUCT ON PRODUCT.productID = ORDERS.productID WHERE ORDERS.orderNumber = $productID";    
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
          <a class="right " href="cart.php">Cart</a>
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
            echo '<center>Order #'.$productID.'</center>';
            echo '<hr>';
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
                    
                    echo '<br>';
                    echo '</form>';
                echo '</div>';
                $currentProduct = $products->fetch_assoc();
                
            }
            echo '<center>Order Total: '.money_format("$%i",$totalCost).'</center>';
            ?>
            <?php
            
            ?>
    </body>
</html>











