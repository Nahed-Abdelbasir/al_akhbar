

<?php


include "init.php";

if(isset($_GET["id"]) && is_numeric($_GET["id"])){
    $id = $_GET["id"];
}else{
    $id = "";
}

$q = "SELECT nah_users.nah_name as 'name' , nah_newinfo.nah_title as 'title' , nah_newinfo.nah_desc as 'desc' , nah_newinfo.nah_image as 'img' , nah_newinfo.nah_date as 'date' FROM nah_newinfo INNER JOIN nah_users ON nah_newinfo.admin_id = nah_users.nah_userid WHERE nah_newinfo.nah_newid = '$id'";


$row  = mysqli_query($conn , $q);
$new = mysqli_fetch_row($row);



?>





<div class="news-data py-5">
    
    <div class="container">
    
    <!------------  news info -------------->

        <div class="info">
            
            <h2><?php echo $new[1] ;?></h2>

            <div class="new-image w-75 m-auto">
                <img class="img-fluid" src="admin/<?php echo $new[3] ;?>" alt="new image"/>
            </div>
            
            <div class="item mt-3">
                <p><?php echo  $new[4] ;?></p>
                <h5>كاتب الخبر : <?php echo $new[0] ;?> </h5>
            </div>
            
            <div class="new-desc py-5 w-75 mx-auto">
                <p><?php echo $new[2] ;?></p>
            </div>
     
       </div>


    <!------------ /news info ----------->
        
        
        
    
        

    </div>

</div>








<?php

   include "includes/footer.php";

?>