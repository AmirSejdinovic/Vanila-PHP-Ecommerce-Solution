
<?php require_once("../../resources/config.php"); 
include(TEMPLATE_BACK . DS . "header.php");

if(!isset($_SESSION['username'] )){
    redirect("../../public");
}

?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                 <!-- FIRST ROW WITH PANELS -->
                <?php
                //Here I created if statement to check if the requested url is equal to url I defined. If the request url is same as defined than show the admin content
                 if($_SERVER['REQUEST_URI'] == '/ecomm/Vanila-PHP-Ecommerce-Solution/public/admin/' || $_SERVER['REQUEST_URI'] == "/ecomm/Vanila-PHP-Ecommerce-Solution/public/admin/index.php") {
                    include(TEMPLATE_BACK . DS . "admin_content.php");
                 }

                 //If the url have the get request with key 'orders' than include orders.php page
                if(isset($_GET['orders'])){
                    include(TEMPLATE_BACK . DS . "orders.php");
                }
                //If the url have the get request with key 'add_product' than include add_product.php page
                if(isset($_GET['add_product'])){
                    include(TEMPLATE_BACK . DS . "add_product.php");
                }
                //If the url have the get request with key 'edit_product' than include edit_product.php page
                if(isset($_GET['edit_product'])){
                    include(TEMPLATE_BACK . DS . 'edit_product.php');
                }
                //If the url have the get request with kex 'categores' than include the categories.php page
                if(isset($_GET['categories'])){
                    include(TEMPLATE_BACK . DS . 'categories.php');
                }
               //If the url have the get request with key of 'products' than include products.php page
                if(isset($_GET['products'])){
                    include(TEMPLATE_BACK . DS . 'products.php');
                }


                 
                
                ?>
             

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    
<?php include(TEMPLATE_BACK . DS . "footer.php"); ?>