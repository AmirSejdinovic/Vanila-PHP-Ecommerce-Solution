<?php require_once("../../resources/config.php"); ?>
<?php// include(TEMPLATE_BACK . DS . "header.php"); ?>

        <div class="col-md-12">
<div class="row">
<h1 class="page-header">
   All Orders


</h1>
<h3 class="bg-success text-center"><?php display_message(); ?></h3>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>S.N</th>
           <th>Amount</th>
           <th>Transaction</th>
           <th>Currency</th>
           <th>Status</th>
           <th>Order Date</th>
           
      </tr>
    </thead>
    <tbody>
        <?php 
        //Here I calling the function which will displayed the data from table orders
        display_orders(); ?>
        

    </tbody>
</table>
</div>











            
<?php include(TEMPLATE_BACK . DS . "footer.php"); ?>
