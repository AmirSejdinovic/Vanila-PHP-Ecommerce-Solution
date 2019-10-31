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
    //Here I created the foreach loop where i use the $_SESSIOn as input and I asigned its to key $name and value $value
    foreach($_SESSION as $name => $value){
       //Here I ceheck if the sesion key is "product_" and I do that with php function substr and i pase the key of foreac loop and asigned the position of 0 to start and position 8 to end 
       if(substr($name, 0, 8) == "product_" ){
          
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
      <td><a class="btn btn-warning" href="cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a> 
      <a class="btn btn-success" href="cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"> </span> 
      <a class="btn btn-danger" href="cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-remove"> </span></a></td>
      </tr>
TEXTPRODUCTS;

      echo $product;

    }
       }
       
    }
    
  }


?>


    