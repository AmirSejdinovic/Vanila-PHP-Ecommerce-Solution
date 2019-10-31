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
        redirect("checkout.php");
      }else{
        //Else do this
        set_message("<h3 class='text-center'>We only have {$row['product_title']} " . $row['product_quantity'] . " " . " Avaible</h3>");
        redirect("checkout.php");
      }
    }
    //$_SESSION['product_' . $_GET['add']] += 1;
    //redirect("index.php");
  }

  //Here I created the function for remove 
  if(isset($_GET['remove'])){
  //If isset the get with parametar remove than do this
    $_SESSION['product_' . $_GET['remove']]--;

    if($_SESSION['product_' . $_GET['remove']] < 1){
      redirect("checkout.php");
    }else{
      redirect("checkout.php");
    }
  }
//Here I created the function for delete
  if(isset($_GET['delete'])){
    //If get parametar have the key of delete than asigned the session 0 
    $_SESSION['product_' . $_GET['delete']] = '0';
    redirect("checkout.php");
  }
  //Here I created the function for displaying product in cart
  function cart(){
    //Query for selecting all products
    $query = query("SELECT * FROM products");
    //confimr($query);
    //While loop
    while($row = fetch_array($query)){
      //Heredoc
      $product = <<<TEXTPRODUCTS
      <tr>
      <td>{$row['product_title']}</td>
      <td>$23</td>
      <td>3</td>
      <td>2</td>
      <td><a href="cart.php?remove=1">Remove</a></td>
      <td><a href="cart.php?delete=1">Delete</a></td>
      </tr>
TEXTPRODUCTS;

      echo $product;

    }
  }


?>


    