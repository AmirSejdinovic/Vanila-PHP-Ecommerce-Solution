<?php require_once("../resources/config.php"); ?>

<?php
//Here i check if the link has the get parametar with key of add
  if(isset($_GET['add'])){
    
    //If te get parametar have the key of add than make th query and pased it into db
    $query = query("SELECT * FROM products WHERE product_id=" .escape_string($_GET['add']) . "");
    //Testing query
    confirm($query);
    //While loop for fetch db data
    while($row = fetch_array($query)){
      
      //If product quantitiy is not equal sesion quantit thad do code below
      if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]){
        $_SESSION['product_' . $_GET['add']] +=1;
      }else{
        //Else do this
        set_message("We only have" . $row['product_quantity'] . " " . "Avaible");
        redirect("checkout.php");
      }
    }
    //$_SESSION['product_' . $_GET['add']] += 1;
    //redirect("index.php");
  }


?>


    