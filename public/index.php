<?php require_once("../resources/config.php"); ?>
<?php 

//Here I include modlue for header, which I created in resoruces in folder front. Here I use the constant that I created in config.php TEMPLATE_FRONT. Whith this constant I have stored the path to the folder front, and DS constant is the slash that is stored in the constant. 
include(TEMPLATE_FRONT . DS . "header.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!--categories-->
            <?php include(TEMPLATE_FRONT . DS . "side_nav.php"); ?> 
            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                    <?php include(TEMPLATE_FRONT . DS . "slider.php"); ?> 
                    </div>

                </div>

                <div class="row">
              <?php get_products(); ?>
                    

                   

                    

                </div><!--row ends here-->

            </div>

        </div>

    </div>
    <!-- /.container -->

    <?php include(TEMPLATE_FRONT . DS . 'footer.php'); ?>