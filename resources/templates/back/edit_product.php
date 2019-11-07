
<div class="col-md-12">
<?php 


if(isset($_GET['id'])){
 
  $query = query("SELECT * FROM products WHERE product_id=". escape_string($_GET['id']) ."");
  confirm($query);

  while($row = fetch_array($query)){
    $product_title = $row['product_title'];
     $product_description = $row['product_description'];
     $product_price = $row['product_price'];
     $short_desc = $row['short_desc'];
     $product_category = $row['product_category_id'];
     $product_quanitity = $row['product_quantity'];
     $product_image = $row['product_image'];
     
  }

  
}

$product_image = display_image($product_image);
 //Calling the function for hendeling the update product form
updating_product();
?>
<div class="row">
<h1 class="page-header">
   Edit Product

</h1>
</div>
               


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Product Title </label>
        <input type="text" name="product_title" class="form-control" value="<?php echo $product_title; ?>">
       
    </div>


    <div class="form-group">
           <label for="product-title">Product Description</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control"><?php echo  $product_description; ?></textarea>
    </div>



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" name="product_price" class="form-control" size="60" value="<?php echo $product_price; ?>">
      </div>
    </div>


    <div class="form-group">
           <label for="short_desc">Short Desciption</label>
      <textarea name="short_desc" id="" cols="30" rows="3" class="form-control"><?php echo $short_desc; ?></textarea>
    </div>

   

    
    

</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
       <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
        <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-title">Product Category</label>
          
        <select name="product_category" id="" class="form-control">
            <?php 
            //Calling the function for displaying the dropdown list of categories that stored at our database
            dropdown_category(); ?>
           
        </select>


</div>





    <!-- Product Brands-->


    <div class="form-group">
      <label for="product-title">Product Quantitiy</label>
         <input type="number" class="form-control" name="product_quanitity">
         </select>
    </div>


<!-- Product Tags -->


    <!--<div class="form-group">
          <label for="product-title">Product Keywords</label>
          <hr>
        <input type="text" name="product_tags" class="form-control">
    </div>-->

    <!-- Product Image -->
    <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="file"><br>
        <img width="200" src="../../resources/<?php echo $product_image; ?>" alt="">
      
    </div>



</aside><!--SIDEBAR-->


    
</form>



                



