

<div class="row">

<h1 class="page-header">
   All Products

</h1>
<h3 class="text-center bg-success"><?php display_message(); ?></h3>
<table class="table table-hover">


    <thead>

      <tr>
           <th>Id</th>
           <th>Title</th>
           <th>Category</th>
           <th>Price</th>
           <th>Quantity</th>
      </tr>
    </thead>
    <tbody>

    <?php 
    //Calling the custom function which displays all products from database. The function is located in my functions file
    display_products_admin(); ?>


  </tbody>
</table>











                
                 


             </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->





