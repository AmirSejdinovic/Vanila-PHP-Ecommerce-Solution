<div class="col-md-3">
                <p class="lead">Shop Name</p>
                <div class="list-group">
               <?php

                //Here I created the query which selects all from categories table
                 $query = "SELECT * FROM  categories";
                 //Here I send query into db 
                 $send_query = mysqli_query($connection, $query);
                //This if statement cheks if has error in query and if does it die all the code and display the errors
                 if(!$send_query){
                    die("QUERY FAILED" . mysqli_error($connection));
                 }
                  //This is the while loop with it I fatch the data from database and display ti
                 while($row = mysqli_fetch_array($send_query)){


                  echo "<a href='category.html' class='list-group-item'>{$row['cat_title']}</a>";

                 }


                   ?>

             

                    
                </div>
            </div>