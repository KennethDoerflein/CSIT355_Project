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

        <?php
            if($numOfItemsInCart == 0){
                echo "Your cart is Empty";
            }else{
                for($i = 0; $i < $numOfItemsInCart ; $i++){
                    echo '<div class="productCard">';
                    echo '<div>'.$currentProduct['productID'].'</div>';
                    echo '</div>';
                    $currentProduct = $products->fetch_assoc();
                }
            }
            ?>
    </body>
</html>











