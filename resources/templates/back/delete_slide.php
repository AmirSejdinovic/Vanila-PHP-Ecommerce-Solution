<?php require_once("../../resources/config.php");


//If get request have the key id than do the code below
if(isset($_GET['delete_slide_id'])){
   //Creating query and pasing it to database. With this query I delete order from orders table which has the id from get requiest
  $query = query("DELETE FROM slides WHERE slide_id = ".escape_string($_GET['delete_slide_id']) . "");
  //testing
  confirm($query);
  //Set mesage fro dislay in front end
  set_message("Slide has been deleted");
  //redirecting back to orders page
  redirect("../../../public/admin/index.php?slides");

}else{
  //If the request do not have the key of id than redirect to the ordres again
  redirect("../../../public/admin/index.php?slides");
}

?>