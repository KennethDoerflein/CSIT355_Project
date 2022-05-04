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
    
   
    $activeUser = $_SESSION['account'];
        
    $query = "SELECT DISTINCT orderNumber,purchaseDate FROM ORDERS WHERE accountNumber = $activeUser ORDER BY purchaseDate DESC";    
    $orders = $database->query($query);
    $numOfOrders = mysqli_num_rows($orders);
    $currentOrder = $orders->fetch_assoc();  
    
    // $query1 = "SELECT SUM(price*quantity) FROM ORDERS WHERE accountNumber = $activeUser";    
    // $sum = $database->query($query1);
    // $totalPrice = $sum->fetch_assoc();
    
        
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
            if ($numOfOrders == 0 ){
                echo '<center><br>You have no orders</center>';
            }else{
                for($i = 0; $i < $numOfOrders ; $i++){
                    echo '<form action="./orderDetail.php" method="post">';
                    echo '<div class="cartCard">';
                        echo '<div class = "cart-info">Order #'.$currentOrder['orderNumber'].'</div>';
                        echo '<div class = "cart-info">Date: '.$currentOrder['purchaseDate'].'</div>';
                        //echo '<div class = "cart-info">Total Cost: $'.$totalPrice['SUM(price*quantity)'].'</div>';
                        //echo '<div class = "cart-info">Quantity: '.$numOfPurchasedItems.'</div>';
                        echo' <button class="sButton" name ="productID" value ='.$currentOrder['orderNumber'].'>View</button>';
                        echo '<br>';
                        echo '</form>';
                    echo '</div>';
                    $currentOrder = $orders->fetch_assoc();
                }
            }
            ?>
    </body>
</html>











