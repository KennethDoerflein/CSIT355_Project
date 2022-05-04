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
    
     $query = "SELECT * FROM CUSTOMER WHERE accountNumber = '".$_SESSION['account']."'";
     $accountInfo = $database->query($query);
     $account = $accountInfo->fetch_assoc();
     
     $email = $account['email'];
     $Fname = $account['Fname'];
     $Lname = $account['Lname'];
     $address = $account['address'];
     $phoneNumber = $account['phoneNumber'];
    
    
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
          <a class="right active" href="account.php">Account</a>
          <a class="right" href="cart.php">Cart</a>
          <form action="./searchResults.php" method="post">
              <div class="search-container">
                  <button type="submit">Submit</button>
                  <input type="text" placeholder="Search.." name="search" required>
              </div>
              
          </form>
          
          
        </div>
        <br><br>
        <center>
            <u>Orders</u>
            <form action="./orders.php" method="post">
            <center><button class="sButton">View Orders</button></center>
            </form>
            <br>
            <hr>
        </center>
        <br>
       <div style="text-align: center"><b><u>User Information:</u></div></b>
            <div></div>
            <center>
                <div>
                    First Name: <?php echo $Fname; ?>
                </div>
                <div>
                    Last Name: <?php echo $Lname; ?>
                </div>
                <div>
                    Email Address: <?php echo $email; ?>
                </div>
                <div>
                    Primary Address: <?php echo $address; ?>
                </div>
                <div>
                    Phone Number: <?php echo $phoneNumber; ?>
                </div>
    </body>
</html>