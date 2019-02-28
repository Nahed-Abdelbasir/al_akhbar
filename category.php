
<?php


include "init.php";


//get 20 words of description

function desclimit($desc){
    
    if(str_word_count($desc) > 20){
        $more=" ....... المزيد";
    }else{
        $more="";
    }
    
    $descarray = explode(" " , $desc);
    $slicearray = array_slice($descarray ,0,20);
    $newdesc = implode(" " , $slicearray);

    return $newdesc  . $more;
}


if(isset($_GET["type"])){
    $type = $_GET["type"];
  }else{
    $type = "";
  }



$q = "SELECT nah_title , nah_desc , nah_image , nah_newid FROM nah_newinfo where nah_type = '$type' ORDER BY nah_date DESC";
$allnews  = mysqli_query($conn , $q);



?>





<div class="cat-news py-5">
    
    <div class="container p-5 ">
        
        <h2 class="text-center text-danger mb-5">أخبار <?php echo $type ;?></h2>
    
    <!------------ all cat news -------------->

        <div class="row">

            <?php
               
               while($typenew = mysqli_fetch_array($allnews)) {
            
            ?>
            
            <div class="col-md-4">
                
                <div class="cat-item my-3">
                    <img class="img-fluid" src="admin/<?php echo $typenew[2] ;?>" alt="imagenew"/>
                    <h4><?php echo $typenew[0] ;?></h4>
                    <a href="news.php?id=<?php echo $typenew[3] ;?>">
                        <p><?php echo desclimit($typenew[1]) ;?></p>
                    </a>
                </div>
                
            </div>
            
            <?php } ?>

       </div>


    <!------------ /all cat news ----------->

    </div>

</div>








<?php

   include "includes/footer.php";

?>