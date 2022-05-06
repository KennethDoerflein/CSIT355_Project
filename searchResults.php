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
    
    $search = trim($_POST['search']);
    if(!get_magic_quotes_gpc()) {
        $search = addslashes($search);
    }
    
    if(!$search){
        $notice = 'No results, please try again.';
    }else{
        $query = "SELECT * FROM PRODUCT WHERE name like '%".$search."%' OR description like '%".$search."%' OR manufacturer like '%".$search."%' ORDER BY category DESC";
        $products = $database->query($query);
        $numOfProducts = mysqli_num_rows($products);
        $currentProduct = $products->fetch_assoc();
    }
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
        
        <br>

            <?php
                echo '<br>';
                if($numOfProducts == 0){
                    echo '<div style ="text-align: center">No results, please try again.</div>';
                }else{
                    for($i = 0; $i < $numOfProducts ; $i++){

                        echo '<form action="./productFullView.php" method="post">';
                        echo '<div class="productCard">';
                        echo '<div><img src="'.$currentProduct['image'].'" style="width:100%"></div>';
                        echo '<div><h4>'.$currentProduct['name'].'</h4></div>';
                        echo '<div>$'.$currentProduct['price'].'</div>';
                        echo '<button name ="productID" value ='.$currentProduct['productID'].'>View Product</button>';
                        echo '</form>';
                        echo '</div>';

                        $currentProduct = $products->fetch_assoc();
                    }
                }
            ?>
    </body>
</html>