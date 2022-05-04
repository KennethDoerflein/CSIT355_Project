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
  $name=$_POST['name'];
  $category=$_POST['category'];
  $price=$_POST['price'];
  $manufacturer=$_POST['manufacturer'];
  $description=$_POST['description'];
  $quantity=$_POST['quantity'];
  $image=$_POST['image'];
  $productID = mt_rand(10000,90000);

  if (!$name || !$category || !$price || !$manufacturer || !$description || !$quantity || !$image) {
     $_SESSION['insertProduct'] = 'missingInput';
        header('Location: ../insert.php');
        $database->close();
	    exit();
  }

  if (!get_magic_quotes_gpc()) {
    $name = addslashes($name);
    $category = addslashes($category);
    $manufacturer = addslashes($manufacturer);
    $description = addslashes($description);
    $image = addslashes($image);
    $quantity = doubleval($quantity);
    $price = doubleval($price);
  }

  if (mysqli_connect_errno()) {
     $_SESSION['insertProduct'] = 'connectionFailed';
        header('Location: ../insert.php');
        $database->close();
	    exit();
  }

  $query = "insert into PRODUCT values
            ('".$productID."', '".$name."', '".$category."', '".$price."','".$manufacturer."', '".$description."', '".$quantity."', '".$image."')";
  $result = $database->query($query);

    if($result){
        $_SESSION['insertProduct'] = 'success';
        header('Location: ../insert.php');
	    exit();
    } else{
        $_SESSION['insertProduct'] = 'failed';
        header('Location: ../insert.php');
        $database->close();
	    exit();
    }

  $database->close();
?>