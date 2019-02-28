

 <!---- navbar ------>
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="container">

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                      <li class="nav-item">
                        <a class="nav-link" href="../index.php"><i class="fa fa-home"></i></a>
                      </li>
                      <li class="nav-item active">
                        <a class="nav-link" href="dashboard.php">كل الأخبار</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="addnew.php">إضافة خبر</a>
                      </li>
                        
                        <?php
                        if(isset($_SESSION['id'])){ 
                            ?>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">تسجيل خروج</a>
                            </li>
                            
                       <?php } ?>
                        
                        
                    
                      
                    </ul>
                    
                  </div>

            </div>
          
        </nav>
    

        <!---- /navbar ------>