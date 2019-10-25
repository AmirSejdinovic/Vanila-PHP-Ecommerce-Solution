<?php
  //Creatihg paths for windows and linux servers. 
  //We create here the therniary if operator it is the short hand of if statement and we chack if DS is defined it is return null and if is not defined then it will defined DS as DIRECTORY_SEPARATOR
  defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

  //Here I defied the path for template for front end. I defined the constant and I sign it the terniary if operator. If it is true than do the null if is not true than asigned the constant tmeplate front this path. __DIR__ is a magic PHP constant that return us a root directory path, than DS is a forward slash in linkus and after that i put the path to the folder front where I will put all the files that is relatet to front end
  defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__. DS ."templates/front");
  //Here I defined path for folder back where I will put all the files related to the back of this ecommerce
  defined("TEMPLATE_BACK") ? null : define ("TEMPLATE_BACK", __DIR__ .DS. "templates/back");


?>