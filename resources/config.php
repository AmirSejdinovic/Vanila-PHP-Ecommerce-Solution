<?php
  //Creatihg paths for windows and linux servers. 
  //We create here the therniary if operator it is the short hand of if statement and we chack if DS is defined it is return null and if is not defined then it will defined DS as DIRECTORY_SEPARATOR
  defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
  


?>