<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>الأخبار / news</title>
        <link rel="stylesheet" href="<?php echo $css ;?>bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo $css ;?>all.min.css"/>
        <link rel="stylesheet" href="<?php echo $css ;?>style.css"/>
    </head>
    <body>

        
        <!---- header ------>
        
        <header>
        
            <div class="container p-3">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="logo">
                            <a href="index.php">الأخبار</a>
                        </div>
                    </div>
                    
                    
                    <div class="col-sm-4">
                        <div class="social  text-left">
                            <a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="twitter" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="youtube" href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
             
                
            </div>
        
        </header>
        
        <!---- /header ------>
        
        <!---- navbar ------>
        
        <?php
        $conn = mysqli_connect("localhost" , "root" , "" , "nah_news");

        if(! $conn ){
            die ("couldn't connect ". mysql_error());
        }

        mysqli_query($conn , "set names 'utf8'");


        
        $q1 = "SELECT DISTINCT(nah_type) FROM nah_newinfo limit 5";
        $types = mysqli_query($conn , $q1);
                             
                                                          
        $q2 = "SELECT DISTINCT(nah_type) FROM nah_newinfo limit 5,100"; 
        $types2 = mysqli_query($conn , $q2);
           
                                 
        $q3 = "SELECT DISTINCT(nah_city) FROM nah_newinfo";
        $cities = mysqli_query($conn , $q3); 
                                  
                            
                                  
        ?>
        
        
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            
            <div class="container">
                
                 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                      <li class="nav-item active">
                        <a class="nav-link" href="index.php"><i class="fa fa-home"></i></a>
                      </li>
                        
                        <?php
                        
                           while($type = mysqli_fetch_array($types)) {
                        
                        ?>
                        
                      <li class="nav-item">
                        <a class="nav-link" href="category.php?type=<?php echo $type[0]?>"><?php echo $type[0]?></a>
                      </li>
                        
                      <?php } ?>
                        
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          محافظات
                        </a>
                        <div class="dropdown-menu text-right" aria-labelledby="navbarDropdown">
                                
                            <?php

                               while($city = mysqli_fetch_array($cities)) {

                            ?>


                            <a class="dropdown-item p3" href="index.php?city=<?php echo $city[0] ;?>"><?php echo $city[0] ;?></a>


                            <?php }?>
                                
                        </div>
                      </li>
                        
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          المزيد
                        </a>
                        <div class="dropdown-menu text-right" aria-labelledby="navbarDropdown">
                            
                        <?php
                        
                           while($othertypes = mysqli_fetch_array($types2)) {
                        
                          ?>
                            
                          <a class="dropdown-item" href="category.php?type=<?php echo $othertypes[0] ;?>"><?php echo $othertypes[0] ;?></a>
                            
                          <?php }?>
                            
                        </div>
                      </li>
                    </ul>
                    
                  </div>

            </div>
          
        </nav>

        <!---- /navbar ------>