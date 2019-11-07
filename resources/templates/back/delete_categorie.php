<?php require_once("../../config.php");

//If get request have the key id than do the code below
if(isset($_GET['id'])){
   //Creating query and pasing it to database. With this query I delete order from orders table which has the id from get requiest
  $query = query("DELETE FROM categories WHERE cat_id = ".escape_string($_GET['id']) . "");
  //testing
  confirm($query);
  //Set mesage fro dislay in front end
  set_message("Categorie deleted");
  //redirecting back to orders page
  redirect("../../../public/admin/index.php?categories");

}else{
  //If the request do not have the key of id than redirect to the ordres again
  redirect("../../../public/admin/index.php?categories");
}

?>
