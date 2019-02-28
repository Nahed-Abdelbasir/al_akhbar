<?php



$q = "SELECT nah_title , nah_image FROM nah_newinfo ORDER BY nah_date DESC LIMIT 1";
$latestnews  = mysqli_query($conn , $q);
$row = mysqli_fetch_row($latestnews);


$q1 = "SELECT nah_title , nah_image FROM nah_newinfo WHERE nah_title != '$row[0]' ORDER BY nah_date DESC LIMIT 3 ";
$latestothernews  = mysqli_query($conn , $q1);


?>




<div class="slider-news">
        
        <div class="row">
            
        
            <div class="col-md-6">

                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                      
                    <div class="carousel-item active">
                      <img class="img-fluid" src="admin/<?php echo $row[1];?>" alt="imageslider"  height="200px">
                      <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $row[0]?></h5>
                      </div>
                    </div>
                      
                      <?php   while($latest = mysqli_fetch_array($latestothernews)) { ?>
                      
                    <div class="carousel-item">
                      <img class="img-fluid" src="admin/<?php echo $latest[1] ;?>" alt="imageslider" height="200px">
                      <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $latest[0] ;?></h5>
                      </div>
                    </div>
                      
                   <?php } ?>
                      
                  </div>
                </div>
                

            </div>
            
            
            
            
            <div class="col-md-6">

                <div class="row">
                    
                    <?php
                    
                    $q3 = "SELECT nah_image FROM nah_newinfo ORDER BY nah_date DESC LIMIT 4";
                    $latestimgs  = mysqli_query($conn , $q3);

                    while($img = mysqli_fetch_array($latestimgs)) { 
                    ?>
                    
                    <div class="col-md-6 col-3">
                        <div class="new-image">
                           <img class="img-fluid img-thumbnail my-2" src="admin/<?php echo $img[0];?>" alt="image" /> 
                        </div>
                    </div>
                    
                    <?php } ?>
                    
                </div>

            </div>
            

       </div>

    </div>