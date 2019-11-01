<?php require_once("../resources/config.php");
      //Including cart.php because without of this the function from cart.php which is included in this page will not work
      require_once("cart.php");
      include(TEMPLATE_FRONT . DS . "header.php");
     //if it have the pay paly return kex than do this
     if(isset($_GET['tx'])){
       //storing the value
      $amount = $_GET['amt'];
      $currency = $_GET['cc'];
      $transaction = $_GET['tx'];
      $status = $_GET['st'];

      

      
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