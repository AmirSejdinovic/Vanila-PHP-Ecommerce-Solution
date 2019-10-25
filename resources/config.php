<?php
   //Heere I enamble output buffering. This function will hellp me to not have the error in header() function which is used for redirections
   ob_start();
   //Here i turn on the sessions. 
   session_start();
  //Creatihg paths for windows and linux servers. 
  //We create here the therniary if operator it is the short hand of if statement and we chack if DS is defined it is return null and if is not defined then it will defined DS as DIRECTORY_SEPARATOR
  defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

  //Here I defied the path for template for front end. I defined the constant and I sign it the terniary if operator. If it is true than do the null if is not true than asigned the constant tmeplate front this path. __DIR__ is a magic PHP constant that return us a root directory path, than DS is a forward slash in linkus and after that i put the path to the folder front where I will put all the files that is relatet to front end
  defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__. DS ."templates/front");
  //Here I defined path for folder back where I will put all the files related to the back of this ecommerce
  defined("TEMPLATE_BACK") ? null : define ("TEMPLATE_BACK", __DIR__ .DS. "templates/back");

  //Here I create constant for db host name
  defined("DB_HOST") ? null : define ("DB_HOST", "localhost");
  //Here I create constant for the db user
  defined("DB_USER") ? null : define("DB_USER","root");
  //Here I created constant for db password
  defined("DB_PASSWORD") ? null : define("DB_PASSWORD", "");

  //Here I created constant for db name
  defined("DB_NAME") ? null : define("DB_NAME", "ecom_db");


  //Here I created the variable $connection in which I called the mysqli_connect function and i pased the before created constant with db data as the parametars. This variable $connection will store the core conection to my data base and it will be easier to call this connection
  $connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
  //Because the congig.php file will be included in all filse I here call the file functions.php an require it. Tihs will enable me to have all functions that are stored in functions.php in all files in whici config.php is included.
  require_once("functions.php");

?>