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
      unset($_SESSION['item_total']);
      unset($_SESSION['item_quantity']);
      redirect("checkout.php");
    }else{
      redirect("checkout.php");
    }
  }
//Here I created the function for delete
  if(isset($_GET['delete'])){
    //If get parametar have the key of delete than asigned the session 0 
    $_SESSION['product_' . $_GET['delete']] = '0';
    unset($_SESSION['item_total']);
    unset($_SESSION['item_quantity']);
    redirect("checkout.php");

  }
  //Here I created the function for displaying product in cart
  function cart(){

    $total = 0;
    $item_quantity = 0;
    $item_name = 1;
    $item_number = 1;
    $amount = 1;
    $quantity = 1;
    //Here I created the foreach loop where i use the $_SESSIOn as input and I asigned its to key $name and value $value
    foreach($_SESSION as $name => $value){
      //Here I check if the  value is greather than zero
      if($value > 0){
        
             //Here I ceheck if the sesion key is "product_" and I do that with php function substr and i pase the key of foreac loop and asigned the position of 0 to start and position 8 to end 
       if(substr($name, 0, 8) == "product_" ){

      //Here i sotre the id of the click producti i do it with strlen function
          $length = strlen((int)$name  -8);
       
//Here I store the id
        $id = substr($name, 8, $length);
          
        //Query for selecting all products
   $query = query("SELECT * FROM products WHERE product_id =" .escape_string($id). "");
   //confimr($query);
   //While loop
   while($row = fetch_array($query)){
     $sub = $row['product_price'] * $value;
     $item_quantity += $value;
     //Heredoc
     $product = <<<TEXTPRODUCTS
     <tr>
     <td>{$row['product_title']}</td>
     <td>&#36;{$row['product_price']}</td>
     <td>{$value}</td>
     <td>&#36;{$sub}</td> 
     <td><a class="btn btn-warning" href="cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a> 
     <a class="btn btn-success" href="cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"> </span> 
     <a class="btn btn-danger" href="cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-remove"> </span></a></td>
     </tr>
     <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
     <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
     <input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
     <input type="hidden" name="quantity_{$quantity}" value="{$value}">
TEXTPRODUCTS;

     echo $product;
      
     $item_name++;
     $item_number++;
     $amount++;
     $quantity++;

   }
   //Here I store the total in the session because I want to have it on my disposal all over the page
   $_SESSION['item_total'] = $total += $sub;
   //Here I store the quatntity of items in the cart
   $_SESSION['item_quantity'] = $item_quantity;
      }


      }
  
       
    }
    
  }
//Function for showing paypal button
  function show_paypal(){
    //Session with item quantity has value than do code below
    if(isset($_SESSION['item_quantity'])){

     echo "<input type='image' name='upload' border='0' src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif' alt='PayPal - The safer, easier way to pay online'>";


    }

  
    
  }


?>


    