<?php require_once("../../config.php");

//If get request have the key id than do the code below
if(isset($_GET['id'])){
   //Creating query and pasing it to database. With this query I delete order from orders table which has the id from get requiest
  $query = query("DELETE FROM orders WHERE order_id = ".escape_string($_GET['id']) . "");
  //testing
  confirm($query);
  //Set mesage fro dislay in front end
  set_message("Order Deleted");
  //redirecting back to orders page
  redirect("../../../public/admin/index.php?orders");

}else{
  //If the request do not have the key of id than redirect to the ordres again
  redirect("../../../public/admin/index.php?orders");
}

?>
