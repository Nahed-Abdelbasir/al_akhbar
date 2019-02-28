<?php

$pageName="";

include "init.php";

include "includes/currentnews.php" ;

$query = "";
$qur = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $search = $_POST['search'];
    
    if($search != ""){
        $query = "WHERE nah_title like '%$search%' OR nah_desc like '%$search%'";
        $qur = "AND nah_title like '%$search%' OR nah_desc like '%$search%'";
    }else{
        $query = "";
        $qur = "";
    }
    
}


else if(isset($_GET['city'])){
    $city = $_GET['city'];
    $query = "WHERE nah_city = '$city' ";
    $qur = "AND nah_city = '$city' ";
}else{
    $query = "";
    $qur = "";
}

$q = "SELECT DISTINCT(nah_type) FROM nah_newinfo $query";
$types  = mysqli_query($conn , $q);





?>

                    

<div class="all-news py-4">
    
    <div class="container  py-5 mt-5">
    

        <!------------ /slider news -------------->

        <div class="slider-news pb-4">

            <?php include "includes/slider.php"?>

        </div>


        <!------------ /slider news -------------->



        <!------------ all news -------------->

        <div class="news-items py-5">

            <div class="row">

         <?php   while($type = mysqli_fetch_array($types)) { ?>
                <div class="col-md-3 col-sm-4 my-4">

                    <div class="news-item mt-3">
                        <h3><a href="category.php?type=<?php echo $type[0] ;?>"><?php echo $type[0] ;?></a></h3>
                        
                        
                        <?php 
                        
                        $q = "SELECT nah_title , nah_image , nah_newid FROM nah_newinfo where nah_type = '$type[0]'  $qur ORDER BY nah_date DESC LIMIT 5";
                        $allnews  = mysqli_query($conn , $q);
                                                            
                         while($typenew = mysqli_fetch_array($allnews)) {
                        ?>
  
                        <div class="new-info">
                            <a href="news.php?id=<?php echo $typenew[2] ; ?>">
                                <img class="img-fluid" src="admin/<?php echo $typenew[1] ; ?>" alt="imagenew"/>
                                <h4><?php echo $typenew[0] ; ?></h4>
                            </a>
                        </div>

                         <?php }?>
                        
                        <div class="more text-center p-2">
                            <a href="category.php?type=<?php echo $type[0] ;?>">المزيد</a>
                        </div>


                    </div>


                </div>

             <?php } ?>

           </div>


        </div>


        <!------------ /all news ----------->


    </div>

</div>




<?php

   include "includes/footer.php";

?>