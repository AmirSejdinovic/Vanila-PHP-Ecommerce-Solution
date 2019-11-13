<?php require_once("../../resources/config.php");


//If get request have the key id than do the code below
if(isset($_GET['delete_slide_id'])){

  //Selecting the slide image in database and detect the that image vie slide_id
  $going_insade_db_for_image_name = query("SELECT slide_image FROM slides WHERE slide_id = " . escape_string($_GET['delete_slide_id']) ."LIMIT 1");
  //testing query
  confirm($going_insade_db_for_image_name);
  //Fetching the result
  $row = fetch_array($going_insade_db_for_image_name);
  //Declaring the path to uploads folder
  $target_path = "../../resources/uploads/{$row['slide_image']}";
  //Deleting the image from foleder
  unlink($target_path);
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