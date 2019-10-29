<?php
// ============ Hellper functions ======================
//Here I create the function for redirecting. This functions have argument $location the argument we will fill with in calling function as the parametar
function redirect($location){
  header("Location: $location");
}
//Here I created the function for pasing query into database. The function has the argument which we'll fill when we call the function
function query($sqli){
  global $connection;
  return mysqli_query($connection, $sqli);
}
//Here I created the function for checking if the query has the errors
function confirm($result){
   global $connection;
   if(!$result){
     die("QUERY FAILED". mysqli_error($connection));
   }
}
//Here I created the function form escape sting, with this function we clean the input strings
function escape_string($string){
  global $connection;
  return mysqli_real_escape_string($connection, $string);
}
//Here I created the function for fatching results from database.
function fetch_array($result){

  return mysqli_fetch_array($result);
}

//*****************FRONT END FUNCTIONS*************/
//=======GET PRODUCTS==========
//Here I created function for displaying products from my database
function get_products(){
   //here I call hellper function query() and pass the parametars with slq statement for selecting data in products table
  $query = query("SELECT * FROM products");
  //Here I call another hellper function with this function I test my query
  confirm($query);
  //Here I created the while loop for grabing data from selected table, after that insite the while functio i make the $row variable and asigned it result from another hellper function fetch_array(). That hellper function is working the mysqli_fetch_array function and bring us the data from database
  while($row = fetch_array($query)){
      //Here i use heredoc sintax to easy insert lot of string. This is as the template strings in ES6 Vanila JS. Heredoc start with thre code opener and after that we can declare our token and at the end we put our token and end the php statement.
     $product = <<<TEXTPRODUCTS
     <div class="col-sm-4 col-lg-4 col-md-4">
     <div class="thumbnail">
         <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
         <div class="caption">
             <h4 class="pull-right">&#36;{$row['product_price']}</h4>
             <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
             </h4>
             <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
             <a class="btn btn-primary" target="_blank" href="item.php?id={$row['product_id']}">Add to cart</a>
         </div>
         
     </div>
 </div>
TEXTPRODUCTS;

echo $product;

}
}
//Here I created the function for displying the categories in sidebar
function get_categories(){
     //I use query function to pass the mysqli statement and I store that result in the variable $result
     $resutl = query("SELECT * FROM  categories");
     //Here I test my msqli statemnt with custom function
     confirm($resutl);
     //Here i created while loop and insite the argument i create the $row variable and i use the custom function fetch_array to fetch data from database table
     while($row = fetch_array($resutl)){
      
     echo "<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>";
     }
    

}
/****************BACK END FUNCTIONS***********/



?>