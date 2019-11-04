<?php 
  //Here I start the session because the session_destroy function will not work
  session_start();
 //Here when admin go to logout page we destroy session and that will clear all session data
 session_destroy();
 //After we destroy session we use header php function to redirect the admin to front end index.php
 header("Location: ../../public");

?>