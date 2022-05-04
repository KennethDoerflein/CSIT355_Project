<?php

     // connect to the database
    require_once '../../scripts/connectToDatabase.php';
        
        // start session
    session_start();
    
        if ((isset($_SESSION['active']) && $_SESSION['active']) === false) {
        $_SESSION['loggedin'] = false;
        header('Location: ../login.php');

        //closes db connection
        $database->close();
        exit();
    }
        if(isset($_SESSION["active"])){
        if(time()-$_SESSION["login_time_stamp"] > 1800){
            session_unset();
            session_destroy();
            header("Location: ../login.php");
        }
    }

  // create short variable names
  $productID=$_POST['productID'];
  $name=$_POST['name'];
  $category=$_POST['category'];
  $price=$_POST['price'];
  $manufacturer=$_POST['manufacturer'];
  $description=$_POST['description'];
  $quantity=$_POST['quantity'];
  $image=$_POST['image'];

  if (!$productID) {
     $_SESSION['modifyProduct'] = 'missingInput';
        header('Location: ../modify.php');
        $database->close();
	    exit();
  }

  if (!get_magic_quotes_gpc()) {
    $productID = addslashes($productID);
    $name = addslashes($name);
    $category = addslashes($category);
    $manufacturer = addslashes($manufacturer);
    $description = addslashes($description);
    $image = addslashes($image);
    $quantity = doubleval($quantity);
    $price = doubleval($price);
  }
  
  
  


  if (mysqli_connect_errno()) {
     $_SESSION['modifyProduct'] = 'connectionFailed';
        header('Location: ../modify.php');
        $database->close();
	    exit();
  }

  if($name){
        $query = "UPDATE PRODUCT SET name = '$name' WHERE productID = '$productID'";
        $result = $database->query($query);
  }
  if($category){
        $query = "UPDATE PRODUCT SET category = '$category' where productID = '$productID'";
        $result = $database->query($query);
  }
  if($manufacturer){
        $query = "UPDATE PRODUCT SET manufacturer = '$manufacturer' where productID = '$productID'";
        $result = $database->query($query);
  }
  if($description){
        $query = "UPDATE PRODUCT SET description = '$description' where productID = '$productID'";
        $result = $database->query($query);
  }
  if($image){
        $query = "UPDATE PRODUCT SET image = '$image' where productID = '$productID'";
        $result = $database->query($query);
  }
  if($quantity){
        $query = "UPDATE PRODUCT SET quantity = '$quantity' where productID = '$productID'";
        $result = $database->query($query);
  }
  if($price){
        $query = "UPDATE PRODUCT SET price = '$price' where productID = '$productID'";
        $result = $database->query($query);
  }
  
    if($result){
        $_SESSION['modifyProduct'] = 'success';
        header('Location: ../modify.php');
	    exit();
    } else{
        $_SESSION['modifyProduct'] = 'failed';
        header('Location: ../modify.php');
        $database->close();
	    exit();
    }

  $database->close();
?>