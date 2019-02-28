<?php

session_start();

include "init.php";

include "includes/navbar.php";


if(isset($_SESSION['id'])){
    
    
    if(isset($_GET['choose']) && $_GET['choose'] == "old"){
        $arrange = "";
    }else{
        $arrange = "DESC";
    }
    
    
$q = "SELECT nah_type , nah_image , nah_title , nah_desc , nah_newid FROM nah_newinfo ORDER BY nah_date $arrange ";
$allnews  = mysqli_query($conn , $q);


    
    
?>






<div class="show-news text-center">
    <h2 class="text-center my-5">كل الأخبار</h2>
    <div class="container">
        <div class="choose text-right">
            <a class="btn btn-success select" href="?choose=new"> الأحدث</a>
            <a class="btn btn-danger" href="?choose=old"> الأقدم</a>
        </div>
        
        <?php 
    
             while($all = mysqli_fetch_array($allnews)){
    
        ?>
        
        <div class="items bg-white rounded my-5">
            
            <h3 class="bg-dark text-white text-right rounded p-2"><?php echo $all[0] ;?></h3>
        
            <div class="row">

                <div class="col-md-4">
                    <div class="new-item">
                        <img class="img-fluid img-thumbnail"  src="<?php echo $all[1] ;?>" alt="imgnew"/>
                        <h3><?php echo $all[2] ;?></h3>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="new-item"><?php echo $all[3] ;?></div>
                </div>

                <div class="col-md-4">
                    <div class="new-item">
                        <a class="btn btn-success" href="addnew.php?do=edit&id=<?php echo $all[4] ;?>"><i class="fa fa-check"></i> تعديل</a>
                        <a class="btn btn-danger" href="addnew.php?do=delete&id=<?php echo $all[4] ;?>"><i class="fa fa-times"></i> حذف</a>
                    </div>
                </div>

            </div>
        
        
        </div>
        
        <?php }?>
        
    
    </div>

</div>















<?php

   include "includes/footer.php";
    
}else{
  header("location:index.php");
}

?>