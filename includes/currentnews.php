<?php 

$q = "SELECT nah_title , nah_type FROM nah_newinfo ORDER BY nah_date DESC LIMIT 4";
$latesttitle  = mysqli_query($conn , $q);



?>




<div class="linenews w-75 mx-auto mt-5">
    
    <div class="lines">
        <div class="new w-75 mx-auto text-white text-nowrap">
        
        <?php 

        while($title = mysqli_fetch_array($latesttitle)) { 

        ?>

        <p class="d-inline-block  px-5"><?php echo "<span class='text-dark font-weight-bold'>".$title[1]." /</span> ". $title[0] ;?></p>

        <?php }?>
            
        </div>
        
    </div>

</div>