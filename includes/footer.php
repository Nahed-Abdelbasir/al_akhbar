

<?php
        $conn = mysqli_connect("localhost" , "root" , "" , "nah_news");

        if(! $conn ){
            die ("couldn't connect ". mysql_error());
        }

        mysqli_query($conn , "set names 'utf8'");


        
        $q = "SELECT DISTINCT(nah_type) FROM nah_newinfo limit 15";
        $types = mysqli_query($conn , $q);
?>


         <footer>
           
           <div class="footer-links">
               <div class="container py-5">
                   <div class="row">
                       <div class="col-md-6">
                           <div class="footer-logo text-center">
                               <a href="#">الأخبار</a>
                               <p class="text-white">من حقق أن تعرف ما يحدث فى بلدك</p>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="row">
                               
                               <?php
                        
                               while($type = mysqli_fetch_array($types)) {

                            ?>

                               <div class="col-4">
                                   <div class="footer-link">
                                       <ul class="list-unstyled">
                                           <li><a href="category.php?type=<?php echo $type[0] ; ?>"><?php echo $type[0] ; ?></a></li>
                                       </ul>
                                   </div>
                               </div>
                               
                               <?php } ?>
                               
                           </div>
                       </div>
                   </div>
               </div>
           </div>


           <nav class="navbar navbar-dark bg-dark">
            <div class="container">
                <div class="social  px-5 ">
                    <a href="#" class="text-white mr-4 facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white mr-4 twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white mr-4 youtube"><i class="fab fa-youtube"></i></a>
                </div>
                <p class="text-white mt-2 pt-2 pl-5"> حقوق النشر محفوظه للأخبار 2019 &copy;</p>
    
             </div>
          </nav>

         
        </footer>
        
        <script src="<?php echo $js ;?>jquery-3.3.1.min.js"></script>
        <script src="<?php echo $js ;?>popper.min.js"></script>
        <script src="<?php echo $js ;?>bootstrap.min.js"></script>
        <script src="<?php echo $js ;?>style.js"></script>
    </body>
</html>