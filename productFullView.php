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
    
    if($_SESSION['addCart'] == 'MissingInput'){
        $notice = 'There was an error adding to the cart. Please try again.';
            
        $_SESSION['addCart'] = '';
    }
    
    $productID = trim($_POST['productID']);
    if(!get_magic_quotes_gpc()) {
        $productID = addslashes($productID);
    }
    
    $query = "SELECT * FROM PRODUCT WHERE productID ='$productID'";
    $products = $database->query($query);
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
          <a href="products.php">Products</a>
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
        </center>
        <center><div style='color: red;'><?php echo $notice; ?></div></center>

        <?php
            echo '<form action="./scripts/addToCart.php" method="post">';
                        echo '<div style = "margin: 20px"><img class ="centerIMG" src="'.$currentProduct['image'].'"></div>';
                        echo '<center>';
                        echo '<div style = "margin: 20px"><b>'.$currentProduct['name'].'</b></div>';
                        //echo '<u>Description</u>';
                        echo '<div style = "margin: 20px"><u>Description</u>: '.$currentProduct['description'].'</div>';
                        echo '<div style = "margin: 20px"><u>Category</u>: '.$currentProduct['category'].'</div>';
                        echo '<div style = "margin: 20px"><u>Manufacturer</u>: '.$currentProduct['manufacturer'].'</div>';
                        echo '<div style = "margin: 20px"><u>Price</u>: $'.$currentProduct['price'].'</div>';
                        echo '<div style = "margin: 20px"><label for="qty"><u>Quantity</u>: </label>';
                        echo '<input type="number" id="qty" name="qty" max = "'.$currentProduct['quantity'].'"></div>';
                        echo '<div style = "margin: 20px"><button name ="productID" value ='.$currentProduct['productID'].'>Add to cart</button></div>';
                        echo '</center>';
                        echo '</form>';
        ?>
        <!--<a class="link" href="./scripts/logout.php">Logout</a>-->
        <!--<?php echo $productID; ?>-->
    </body>
</html>