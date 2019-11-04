
<?php require_once("../../resources/config.php"); 
include(TEMPLATE_BACK . DS . "header.php");

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



                 
                
                ?>
             

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    
<?php include(TEMPLATE_BACK . DS . "footer.php"); ?>