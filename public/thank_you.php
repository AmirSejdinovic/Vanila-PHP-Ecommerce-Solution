<?php require_once("../resources/config.php");
      include(TEMPLATE_FRONT . DS . "header.php");
     //if it have the pay paly return kex than do this
     if(isset($_GET['tx'])){
       //storing the value
      $amount = $_GET['amt'];
      $currency = $_GET['cc'];
      $transaction = $_GET['tx'];
      $status = $_GET['st'];
     //Inserting the pay pal return parametars into database
      $query = query("INSERT INTO orders (order_amount, order_transaction, 	order_status, order_currency) VALUES('{$amount}', '{$transaction}', '{$status}', '{$currency}')");
      //Testing query
      confirm($query);
      
      reports();


      //destroying the session for reset 
      //session_destroy();
      
     }else{
       //if the request do not have the get with kex of tx than redirect to index.php
       redirect("index.php");
     }
?>

    <!-- Page Content -->
    <div class="container">

  <h1 class="text-center">THANK YOU</h1>


 </div><!--Main Content-->


           <hr>

           <?php include(TEMPLATE_FRONT . DS . 'footer.php'); ?>   