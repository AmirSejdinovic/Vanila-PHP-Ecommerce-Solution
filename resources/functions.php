<?php

//Here I create the function for redirecting. This functions have argument $location the argument we will fill with in calling function as the parametar
function redirect($location){
  header("Location: $location");
}
//Here I created the function for pasing query into database. The function has the argument which we'll fill when we call the function
function query($sqli){
  global $connection;
  return mysqli_query($connection, $sql);
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

?>