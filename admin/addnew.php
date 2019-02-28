<?php

session_start();

include "init.php";

include "includes/navbar.php";


if(isset($_SESSION['id'])){
    
    
    
    
    if(isset($_GET['do'])){
        $operation = $_GET['do'] ;
    }else{
        $operation = "add";
    }
    
    
    if($operation == "add"){
        
        
        
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $title   = $_POST['title'];
    $desc    = $_POST['desc'];
    $type    = $_POST['type'];
    $city    = $_POST['city'];
    $img     = $_FILES['image'];
    $id      = $_SESSION['id'];   
        
    
    $imgName = $img["name"];
    $imgType = $img["type"];
    $imgSize = $img["size"];
    $imgTmp  = $img["tmp_name"];
        
    $ext = strstr($imgName , '.');
    $extention = str_replace(".","",$ext);      
    $imgsext = array("png" , "jpg" , "jpeg" , "gif") ;
        
        
    $formErrors = array() ;
        
    if(empty($title)){
       $formErrors[] = "يجب كتابة عنوان الخبر";
    }
    if(strlen($title) < 3){
          $formErrors[] = " عنوان الخبر يجب أن يكون أكثر من <strong>3</strong> حروف";
    }
    if(strlen($title) > 100){
          $formErrors[] = " عنوان الخبر يجب أن يكون أقل من <strong>100</strong> حرف ";
    }
    if(empty($desc)){
       $formErrors[] = "يجب كتابة وصف الخبر";
    }
    if(strlen($desc) < 5){
       $formErrors[] = " وصف الخبر يجب أن يكون أكثر من <strong>5</strong> حروف";
    }
    if(empty($type)){
       $formErrors[] = "يجب كتابة نوع الخبر";
    }
    if(strlen($type) < 2){
          $formErrors[] = "نوع الخبر يجب أن يكون أكثر من حرفين";
    }
    if(strlen($type) > 30){
       $formErrors[] = "نوع الخبر يجب أن يكون أقل من  <strong>30</strong> حرف";
    }
    if(empty($city)){
       $formErrors[] = "يجب كتابة المدينه";
    }
    if(strlen($city) < 3){
          $formErrors[] = " المدينه يجب أن تكون أكثر من  <strong>3</strong>  حروف";
    }
    if(strlen($city) > 30){
       $formErrors[] = " المدينه يجب أن تكون أقل من <strong>30</strong> حرف";
    }
    if(!empty($imgName) && !in_array($extention , $imgsext)){
        $formErrors[] = "امتداد هذه الملف غير مسموح به";
    }
    if($imgSize > 4194304){
        $formErrors[] = "<strong>4MB</strong> حجم الملف يجب أن تكون أقل من";
    }
        
        
        //check if there is error
        
        if(!empty($formErrors)){
            echo "<div class='alert alert-danger w-50 m-auto'><div>خطأ !</div>";
                foreach($formErrors as $error){
                    echo "<div class='p-2'>".$error."</div>";
                }
            echo "</div>";
        }else{
            
            
            $randomvalue = rand(1000 , 10000000) ;  
            $finalName    = "upload/".date('y-m-d h-i-s') . $randomvalue . $imgName;
            move_uploaded_file($imgTmp , $finalName );


            $q       = "SELECT *  FROM nah_newinfo WHERE nah_title = '$title'";
            $result  = mysqli_query($conn , $q);
            $count   = mysqli_num_rows($result);


             if($count > 0){

               echo "<div class='alert alert-danger text-center w-50 m-auto'> هذا الخبر تم ادخاله مسبقا </div>";

            }else{
               
                $q = "INSERT INTO nah_newinfo 
                                ( nah_title , nah_desc , nah_type , nah_city , nah_date , nah_image , admin_id ) 
                        VALUES
                                 ('$title' , '$desc' , '$type' , '$city' , now() , '$finalName' , '$id')";

                $result  = mysqli_query($conn , $q);

                 
                 echo "<div class='alert alert-success text-center w-50 m-auto'> تم إضافة الخبر بنجاح </div>";
            
            }

       
        }

}

    
    
?>

<div class="container py-5">
    <h1 class="text-center">أضف خبر جديد</h1>
    <div class="add-new py-5">
        
        <form class="form-add w-75 mx-auto my-4" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" accept-charset="utf8">
            <div class="form-group">
                <label>عنوان الخبر</label>
                <input class="form-control"  type="text" name="title" value=""  required="required"/>
            </div>
            <div class="form-group">
                <label>وصف الخبر</label>
                <textarea class="form-control"  name="desc" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>نوع الخبر</label>
                <input class="form-control"  type="text" name="type" value="" required="required"/>
            </div>
            <div class="form-group">
                <label>المدينه</label>
                <input class="form-control"  type="text" name="city" value="" required="required"/>
            </div>
            <div class="form-group">
                <label>صورة الخبر</label>
                <input class="form-control"  type="file" name="image" value=""  required="required"/>
            </div>

            <button class="btn btn-info mt-4 float-left" type="submit">إضافة خبر</button>
            
            <div class="clearfix"></div>

        </form>
    </div>
    
</div>


        
  <?php      
        
    }elseif($operation == "edit"){
        
        //====================== update element of news =============
        
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = $_GET['id'] ;
        }else{
            $id = "";
        }
        
    
        
         $q = "SELECT nah_title , nah_desc , nah_type , nah_city , nah_image FROM nah_newinfo WHERE nah_newid = '$id'";
         $item  = mysqli_query($conn , $q);
         $row = mysqli_fetch_row($item);
        
        
        
        
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
    
            $id       = $_POST['id'];
            $title   = $_POST['title'];
            $desc    = $_POST['desc'];
            $type    = $_POST['type'];
            $city    = $_POST['city'];
            $img     = $_FILES['image'];
            $admin_id      = $_SESSION['id'];
            $oldimg     = $_POST['oldimage'];
            


            $imgName = $img["name"];
            $imgType = $img["type"];
            $imgSize = $img["size"];
            $imgTmp  = $img["tmp_name"];

            $ext = strstr($imgName , '.');
            $extention = str_replace(".","",$ext);      
            $imgsext = array("png" , "jpg" , "jpeg" , "gif") ;


            $formErrors = array() ;

            if(empty($title)){
               $formErrors[] = "يجب كتابة عنوان الخبر";
            }
            if(strlen($title) < 3){
                  $formErrors[] = " عنوان الخبر يجب أن يكون أكثر من <strong>3</strong> حروف";
            }
            if(strlen($title) > 300){
                  $formErrors[] = " عنوان الخبر يجب أن يكون أقل من <strong>300</strong> حرف ";
            }
            if(empty($desc)){
               $formErrors[] = "يجب كتابة وصف الخبر";
            }
            if(strlen($desc) < 5){
               $formErrors[] = " وصف الخبر يجب أن يكون أكثر من <strong>5</strong> حروف";
            }
            if(empty($type)){
               $formErrors[] = "يجب كتابة نوع الخبر";
            }
            if(strlen($type) < 2){
                  $formErrors[] = "نوع الخبر يجب أن يكون أكثر من حرفين";
            }
            if(strlen($type) > 30){
               $formErrors[] = "نوع الخبر يجب أن يكون أقل من  <strong>30</strong> حرف";
            }
            if(empty($city)){
               $formErrors[] = "يجب كتابة المدينه";
            }
            if(strlen($city) < 3){
                  $formErrors[] = " المدينه يجب أن تكون أكثر من  <strong>3</strong>  حروف";
            }
            if(strlen($city) > 30){
               $formErrors[] = " المدينه يجب أن تكون أقل من <strong>30</strong> حرف";
            }
            if(!empty($imgName) && !in_array($extention , $imgsext)){
                $formErrors[] = "امتداد هذه الملف غير مسموح به";
            }
            if($imgSize > 4194304){
                $formErrors[] = "<strong>4MB</strong> حجم الملف يجب أن تكون أقل من";
            }


                //check if there is error

                if(!empty($formErrors)){
                    echo "<div class='alert alert-danger w-50 m-auto'><div>خطأ !</div>";
                        foreach($formErrors as $error){
                            echo "<div class='p-2'>".$error."</div>";
                        }
                    echo "</div>";
                }else{
                    
                   

                    $q       = "SELECT *  FROM nah_newinfo WHERE nah_title = '$title' AND nah_newid != '$id'";
                    $result  = mysqli_query($conn , $q);
                    $count   = mysqli_num_rows($result);


                     if($count > 0){

                       echo "<div class='alert alert-danger text-center w-50 m-auto'> هذا الخبر تم ادخاله مسبقا </div>";
                       header("REFRESH:3;URL=dashboard.php");

                    }else{
                         
                         if(empty($imgName)){
                        
                            $finalName = $oldimg;
                        
                        }else{

                            $randomvalue = rand(1000 , 10000000) ;  
                            $finalName    = "upload/".date('y-m-d h-i-s') . $randomvalue . $imgName;
                            move_uploaded_file($imgTmp , $finalName );

                        }


                        $q = "UPDATE nah_newinfo SET nah_title = '$title' , nah_desc = '$desc' , nah_type = '$type' , nah_city = '$city' , nah_image =     '$finalName' , admin_id= '$admin_id' WHERE nah_newid = '$id'";
                                        
                        $result  = mysqli_query($conn , $q);


                         echo "<div class='alert alert-success text-center w-50 m-auto'> تم تعديل الخبر بنجاح </div>";
                         
                         header("REFRESH:3;URL=dashboard.php");

                    }


                }

        }



        ?>

        <div class="container py-5">
            <h1 class="text-center">تعديل الخبر</h1>
            <div class="add-new py-5">

                <form class="form-add w-75 mx-auto my-4" action="?do=edit" method="post" enctype="multipart/form-data" accept-charset="utf8">
                    <input type="hidden" name="id" value="<?php echo $id ;?>"/>
                    <div class="form-group">
                        <label>عنوان الخبر</label>
                        <input class="form-control"  type="text" name="title" value="<?php echo $row[0] ;?>"  required="required"/>
                    </div>
                    <div class="form-group">
                        <label>وصف الخبر</label>
                        <textarea class="form-control"  name="desc" rows="5"><?php echo $row[1] ;?></textarea>
                    </div>
                    <div class="form-group">
                        <label>نوع الخبر</label>
                        <input class="form-control"  type="text" name="type" value="<?php echo $row[2] ;?>" required="required"/>
                    </div>
                    <div class="form-group">
                        <label>المدينه</label>
                        <input class="form-control"  type="text" name="city" value="<?php echo $row[3] ;?>" required="required"/>
                    </div>
                    <div class="form-group">
                        <label>صورة الخبر</label>
                        <input class="form-control"  type="file" name="image" value="<?php echo $row[4] ;?>" />
                        <input type="hidden" name="oldimage" value="<?php echo $row[4] ;?>"/>
                    </div>

                    <button class="btn btn-info mt-4 float-left" type="submit">تعديل خبر</button>

                    <div class="clearfix"></div>

                </form>
            </div>

        </div>


        
  <?php      
        
        
        
    }elseif($operation == "delete"){
        
        
        //====================== delete element of news =============
        
        
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = $_GET['id'] ;
        }else{
            $id = "";
        }
        
        
        
        $q = "SELECT * FROM nah_newinfo WHERE nah_newid = '$id'";
        $item  = mysqli_query($conn , $q);
        $count = mysqli_num_rows($item);
        
        if($count > 0){
            
            $q = "DELETE FROM nah_newinfo WHERE nah_newid = '$id'";
            $item  = mysqli_query($conn , $q);
            
            echo "<div class='alert alert-success w-50 mx-auto mt-5'>لقد تم حذف العنصر بنجاح </div>";
            
            header("REFRESH:3;URL=dashboard.php");
            
            
        }else{
            echo "<div class='alert alert-danger w-50 mx-auto mt-5'>هذا العنصر غير موجود </div>";
            header("REFRESH:3;URL=dashboard.php");
        }

        
        
        
   }
    

   
        
        



   include "includes/footer.php";
    
}else{
  header("location:index.php");
}

?>