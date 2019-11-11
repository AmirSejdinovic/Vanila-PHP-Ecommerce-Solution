

<div class="row">

<h1 class="page-header">
   All Products

</h1>
<h3 class="text-center bg-success"><?php display_message(); ?></h3>
<table class="table table-hover">


    <thead>

      <tr>
           <th>Id</th>
           <th>Product id</th>
           <th>Order id</th>
           <th>Price</th>
           <th>Product Title</th>
           <th>Quantity</th>
      </tr>
    </thead>
    <tbody>

      <?php 
      //Calling the function to disyplay the reports from database
      get_reports_in_admin(); ?>


  </tbody>
</table>











                
                 


             </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->





