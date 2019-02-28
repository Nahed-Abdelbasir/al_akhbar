<?php

session_start();

include "init.php";
echo "<hr>";

if(isset($_SESSION['id'])){
    header("location:dashboard.php");
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $name     = $_POST['admin'];
    $password = $_POST['adminpass'];
    
    $pass = sha1($password);
  
    
    $q       = "SELECT nah_userid , nah_name  FROM nah_users WHERE nah_name = '$name' AND nah_password = '$pass' ";
    $result  = mysqli_query($conn , $q);
    $rows    = mysqli_fetch_array($result);
    $count   = mysqli_num_rows($result);
    
    
     if($count > 0){
        
        $_SESSION['id'] = $rows[0];
        header("location:dashboard.php");
       
    }else{
        echo "<div class='alert alert-danger text-center w-50 m-auto'> خطأ! هذا الأدمن غير صحيح </div>";
    }

    
    
}

?>



<div class="container py-5 my-5">
    <form class="form-login w-25 mx-auto my-5" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <div class="form-group">
            <input class="form-control"  type="text" name="admin" value="" placeholder="اسم الادمن" autocomplete="off" required="required"/>
        </div>
        <div class="form-group">
            <input class="form-control"  type="password" name="adminpass" value="" placeholder="الرقم السرى" autocomplete="new-password" required="required"/>
        </div>
        
        <button class="btn btn-primary w-100" type="submit">تسجيل دخول</button>
    
    </form>
</div>



<?php

   include "includes/footer.php";

?>