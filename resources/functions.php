<?php
// ============ Hellper functions ======================
//Seting up the name of folders with images in the $uplaods variable this is important because it will enable us to easy change it if the folder be changed
$uploads = "uploads";

function last_id(){
  global $connection;
  return mysqli_insert_id($connection);
}
//Here I create the function for set mesage via super global variable $_SESSIOn. In this function I pased variable $msg as parametar. This parametar ($msg) we will fil when we call this function
function set_message($msg){
  //If statement that test if the variable $msg is empty. If it is empty the to the code block below
   if(!empty($msg)){
     //If the $msg is empty then we created the global varialbe $_SESSION with message parametar and asigned it the value of $msg
     $_SESSION['message'] = $msg;

   }else{
     //If ti is not empty then we set the blank $msg varaiable
     $msg = "";
   }
}
//Here I created the function for dislaying set mesage 
function display_message(){
  //If there are session with parametar message the to this cocde
  if(isset($_SESSION['message'])){
    //Display the message
    echo $_SESSION['message'];
    //Unset session 
    unset($_SESSION['message']);
  }
}
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
    $product_image = 
    //Calling the function for displying images
    display_image($row['product_image']);
      //Here i use heredoc sintax to easy insert lot of string. This is as the template strings in ES6 Vanila JS. Heredoc start with thre code opener and after that we can declare our token and at the end we put our token and end the php statement.
     $product = <<<TEXTPRODUCTS
     <div class="col-sm-4 col-lg-4 col-md-4">
     <div class="thumbnail">
         <a href="item.php?id={$row['product_id']}"><img src="../resources/{$product_image}" alt=""></a>
         <div class="caption">
             <h4 class="pull-right">&#36;{$row['product_price']}</h4>
             <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
             </h4>
             <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
             <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
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
//This is the function for displaying the products in the category
function category_items(){
  //Here I use the query function and I pased the parametar as mysqli statement
  $result = query("SELECT * FROM products WHERE product_category_id= " .escape_string($_GET['id']) . " ");
  //Testing query
  confirm($result);
  //while loop
  while($row = fetch_array($result)){
    $picture  = display_image($row['product_image']);
    //heredoc
    $product = <<<TEXTPRODUCTS
    <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="../resources/{$picture}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['short_desc']}</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
TEXTPRODUCTS;
//displaying the products
echo $product;
  }
  
}

function shop_items(){
  //Here I use the query function and I pased the parametar as mysqli statement
  $result = query("SELECT * FROM products ");
  //Testing query
  confirm($result);
  //while loop
  
  while($row = fetch_array($result)){
    $product_image = display_image($row['product_image']);
    //heredoc
    $product = <<<TEXTPRODUCTS
    <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="../resources/{$product_image}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['short_desc']}</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
TEXTPRODUCTS;
//displaying the products
echo $product;
  }
  
}

//Here I created the function for login users
function login_user(){
  //Here I check if the user click on submit button. It user click the submit button the do this block of code
   if(isset($_POST['submit'])){
     //Here I store the value that are cleaned with custom fucntion which contains mysqli_esacape_string. The mysqli_escape_strign function do not alowed the mysqli injection
     $username = escape_string($_POST['username']);
     $password = escape_string($_POST['password']);

     //Here I create the query to select all users where inputed username and password are matched with the username and password in database
     $query  = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' ");
     //Testing query
     confirm($query);
     //Here I cehck if there are zero rows of the query in database 
     if(mysqli_num_rows($query) == 0){
       //If it not find the user with username and password in db then via custom function redirect to login page
       //We set the mesage that will display if the username and password not match with db
       set_message("Your password or username are wrong");
         redirect("login.php");
     }else{

       //If ti find the user with inputed username and password the redirect to admin
       //Here I make the SESSION with key 'username' and asigned it the value of loged user. This is important because I will in the admin section build code that only enable the logedin users to access to admin panel
       $_SESSION['username']  = $username;
       //Displaying mesage in admin for login user
       //set_message("Wellcome to admin {$username}");
       redirect("admin");
     }



   }

}
//Here I created the function for procesing contact form
function send_message(){
  //If statement that check if the user is clicked the submit button
  if(isset($_POST['submit'])){
    //If user is clicked the submit button than store the value of inputs in these variables
    $to        = "amir@gmail.com";
    $from_name = $_POST['name'];
    $email     = $_POST['email'];
    $subject   = $_POST['subject'];
    $message   = $_POST['message'];
    //This is the header of email
    $headers = "From: {$from_name} {$email}";
    //We stored the mail() function in the $result variable. I do that because I want to test if the mail is send or not
    $result = mail($to, $subject, $message, $headers);
    //If statement that check if the mail is not send 
    if(!$result){
      //If mail is not send do this
      echo "ERROR";
      set_message("Sorry we could not send your email");
      redirect("contact.php");
    }else{
      //If mail is send than do this
      echo "SENT";
      set_message("Your message is been sent");
    }
  }
}

/****************BACK END FUNCTIONS***********/
//Here I created the function for displaying the data from orders table. This function I will use in the admin section for displaying the ordres
function display_orders(){
  //Here I created and pased the query inside db. I pased the query with my custom function query()
  $query = query("SELECT * FROM orders");
  //Query testing
  confirm($query);
  //While loop for grabing data from data base. Here in the parametars of the function I use also the custom function named fetch_array
  while($row = fetch_array($query)){
     //heredoc
    $orders = <<<TEXTPRODUCTS
    <tr>
    <td>{$row['order_id']}</td>
    <td>{$row['order_amount']}</td>
    <td>{$row['order_transaction']}</td>
    <td>{$row['order_currency']}</td>
    <td>{$row['order_status']}</td>
    <td><a href="../../resources/templates/back/delete_order.php?id={$row['order_id']}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
TEXTPRODUCTS;
    //echoing
    echo $orders;

  }
}
/**************ADMIN PRODUCTS**************/
//Here I created the function for path to the uploads folder. The function have the parameter wihic will pased with arguments
function display_image($picture){
  //Here I create variable $uploads as global because it was declared on the top and I want to use it on this scope if it is not global it can be used in the scope of this function
  global $uploads;
  //Here I return the path to the uploads folder and picture.
   return $uploads . DS . $picture;
}
//Here I created the custom function for displaying all products fom database in admin panel
function display_products_admin(){
  //Creating query that selects all rows from products tables and sending it to the db
  $query = query("SELECT * FROM products");
  //Testing query
  confirm($query);
  //While loop with who I fetch all data from rows and display it
  while($row = fetch_array($query)){
    //Calling the function below and pasing the arguments and also storing the return value in this variable
    $category = show_product_category($row['product_category_id']);
    $porduct_image = display_image($row['product_image']);
    //heredoc
    $products = <<<TEXTPRODUCTS
    <tr>
    <td>{$row['product_id']}</td>
    <td>{$row['product_title']}<br>
    <a href="index.php?edit_product&id={$row['product_id']}"><img width='100' src="../../resources/{$porduct_image}" alt=""></a>
    </td>
    <td>{$category}</td>
    <td>{$row['product_price']}</td>
    <td>{$row['product_quantity']}</td>
    <td><a href="../../resources/templates/back/delete_product.php?id={$row['product_id']}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
TEXTPRODUCTS;
//echoing products
echo $products;
  }
  
}
//Here I created the function for realting database rows and on basic of category id that is pased in for of adding products we here select that categorie and display its name. This function has the parametar that is variable and this parametar will store the value from arguments which we pased when we call the funciton
function show_product_category($product_category_id){
  //Query for selecting only category with cat_id of arguments
$cat_query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");
//Testing query
confirm($cat_query);
//While loop for fetching data form database
while($cat_row = fetch_array($cat_query)){
  //I here return the value of cat_title row
   return $cat_row['cat_title'];
}
}


/***************ADDING PRODUCTS IN ADMIN***********/
//Here I created custom function for addin products
function add_product(){
  //If user cliks on the publish button than do this code below. This prevent to have an error displayed when we first time load the page with this fomr
  if(isset($_POST['publish'])){
    //Storing input values in variables and cleaning up the inputs with custom function escape_string which is basicaly the mysqli_real_escape_string function
    $porduct_title = escape_string($_POST['product_title']);
    $product_description = escape_string($_POST['product_description']);
    $product_price = escape_string($_POST['product_price']);
   $porduct_category = escape_string($_POST['product_category']);
    //$product_brand = escape_string($_POST['product_brand']);
    //$product_tags = escape_string($_POST['product_tags']);
    $produc_quantitiy = escape_string($_POST['product_quanitity']);
    $short_desc = escape_string($_POST['short_desc']);
    //Puling up the images and storing in variable
    $product_image = $_FILES['file']['name'];
    //Storing in variable the temp location of file
    $image_temp_location = $_FILES['file']['tmp_name'];
    //This is the native php function for moving uploaded file this function has two arguments first is the temp location and second is the path to the folder and name of picture. I use here constants for define path, constatns I defined in config php file, the DS constant is just the folder separator
    move_uploaded_file($image_temp_location,UPLOAD_DIRECTORY . DS . $product_image );

    $query = query("INSERT INTO products(	product_title, product_category_id, product_price, product_quantity, 	product_description, short_desc, 	product_image) VALUES ('{$porduct_title}', '{$porduct_category}','{$product_price}', '{$produc_quantitiy}' ,'{$product_description}', '{$short_desc}', '{$product_image}' )");
    
    confirm($query);

    

    set_message("New Product Just added");
    redirect("index.php?products");


  }
}
//Here I created the function for selecting all categories from database and display it in the dropdown list for form in adding products
function dropdown_category(){
  $query = query("SELECT * FROM categories");
  confirm($query);

  while($row = fetch_array($query)){
   $cat_id =  $row['cat_id'];
   $cat_title = $row['cat_title'];
     
   echo "<option value='{$cat_id}'>{$cat_title}</option>";
    
  }
}
//Here I created the function for updating products from edit products page in admin section
function updating_product(){
  //If statement that cheks if the button with name update was clicked. If the button is clicked than do the code in the if code block. This prevents the throwing the erros when user go first time in the page with this form
  if(isset($_POST['update'])){
    //Storing values in variables
     $product_title = escape_string($_POST['product_title']);
     $product_description = escape_string($_POST['product_description']);
     $product_price = escape_string($_POST['product_price']);
     $short_desc = escape_string($_POST['short_desc']);
     $product_category = escape_string($_POST['product_category']);
     $product_quanitity = escape_string($_POST['product_quanitity']);
     $product_image = $_FILES['file']['name'];
     $temp_image = $_FILES['file']['tmp_name'];
     
       //Here I created if statement where I check if the variable $product_image is empty than do the query and find out the image in db for that product on product id.
     if(empty($product_image)){
       $get_pic = query("SELECT product_image FROM  products WHERE product_id =" . escape_string($_GET['id']) . "");
       //testing qery
       confirm($get_pic);
       //Creating while loop and asigned the database value of pic in variable
       while($pic = fetch_array($get_pic)){
         $product_image = $pic['product_image'];
       }
     }
     //Moving the uploaded picture into the images dir
     move_uploaded_file($temp_image, UPLOAD_DIRECTORY . DS . $product_image);
    //Query for update the values in database. This query is split in more peaces because it is eaisier to read it. I split it with same variable but i use the concatitantion propraty
    $update_query = "UPDATE products SET ";
    $update_query .= "product_title = '{$product_title}', ";
    $update_query .= "product_category_id = '{$product_category}', ";
    $update_query .= "product_price = '{$product_price}', ";
    $update_query .= "product_quantity = {$product_quanitity}, ";
    $update_query .= "product_description = '{$product_description}', ";
    $update_query .= "short_desc = '{$short_desc}', ";
    $update_query .= "product_image= '{$product_image}' ";
    $update_query .= "WHERE product_id=" .escape_string($_GET['id']) ." ";



     //Here I send the query into db via my custom function
    $send_update_query = query($update_query );
    
    confirm($send_update_query);
    set_message("Product has been updated");
    redirect("index.php?products");

  }
}


/****CATEGORIES IN ADMIN*****/
//Here I created the function for displying the categories form database
function show_categories_in_admin(){
  //Here I created the query for selecting all fields from categories table
  $query = "SELECT * FROM categories";
  //Here I send query in db via my custom function
  $send_category =  query($query);
  //Testing query via custom function
  confirm($send_category);
  //While loop for fetching data from data base
  while($row = fetch_array($send_category)){
    //Storing the values from database in variables
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];
    //Heredocs
    $category =<<<TEXTPRODUCTS
    <tr>
    <td>{$cat_id}</td>
    <td>{$cat_title}</td>
    <td><a href="../../resources/templates/back/delete_categorie.php?id={$cat_id}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
TEXTPRODUCTS;
echo $category;
  }
}
//Here I created the funtion for adding categories from admin panel into db
function add_category(){
  //Here I check if the user is clicked on the button with name of add_category. If he is click than do the code block bleow
  if(isset($_POST['add_category'])){
    //Storing the value from input and cleaning it up with my custom function
    $cat_title = escape_string($_POST['cat_title']);

    if(empty($cat_title) || $cat_title == " "){
      echo "<p class='text-center bg-danger'>This canot be empty</p>";
    }else{
     //Creating query for insertion into table of database
    $query = query("INSERT INTO categories(cat_title) VALUES('{$cat_title}') ");
    //testing query
    confirm($query);
    set_message("Category created");
    
  }
}
}
/**ADMIN USERS*****/

function dispying_users_in_admin(){
  $user_query =  query("SELECT * FROM users");
  confirm($user_query);

  while($row = fetch_array($user_query)){
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_email = $row['email'];
    $user_password = $row['password'];

    $users =<<<TEXTPRODUCTS
    <tr>
    <td>{$user_id}</td>
    <td>{$username}</td>
    <td>{$user_email}</td>
    <td><a href="../../resources/templates/back/delete_user.php?id={$user_id}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
TEXTPRODUCTS;
  echo $users;

  }
}
function add_user(){
  if(isset($_POST['add_user'])){
    $usename = escape_string($_POST['username']);
    $email = escape_string($_POST['email']);
    $password = escape_string($_POST['password']);
    //$user_photo = $_FILES(['file']['name']);
    //$photo_temp = $FILES(['file']['tmp_name']);

    //move_uploaded_file($photo_temp, UPLOAD_DIRECTORY . DS . $user_photo);

    $query = query("INSERT INTO users(username,email,password) VALUES ('{$usename}','{$email}','{$password}') ");
    confirm($query);
    set_message("user created");
    redirect("index.php?users");
  }
}
//Here I created function for dispying the all reports from database
function get_reports_in_admin(){
  //Query for selecting it
  $query = query("SELECT * FROM reports");
  //Testing query
  confirm($query);
   //While loop
  while($row = fetch_array($query)){
    //Storing values form database in variables
    $report_id = $row['report_id'];
    $product_id = $row['product_id'];
    $product_price = $row['product_price'];
    $product_quantitiy = $row['product_quantity'];
    $product_title = $row['product_title'];
    //heredoc
    $reports =<<<TEXTPRODUCTS
    <tr>
    <td>{$report_id}</td>
    <td>{$product_id}</td>
    <td>{$product_price}</td>
    <td>{$product_title}</td>
    <td>{$product_quantitiy}</td>
    <td><a href="../../resources/templates/back/delete_reports.php?id={$report_id}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
TEXTPRODUCTS;
echo $reports;
  }
}


?>