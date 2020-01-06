<?php

include_once 'includes/connection.php'; 
?>

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <?php
    
   
      $query = "SELECT * FROM school_profile";
    $query_run = mysqli_query($connection,$query);
if(mysqli_num_rows($query_run) > 0){
    foreach ($query_run as $row) {
      
    
    ?>
            <span><i class="fas fa-fw fa-address-book"></i>&nbsp;<?php echo $row['school_address']?></span>
            <?php
}
} else {
?>         
 <span><i class="fas fa-fw fa-address-book"></i>&nbsp;School Address</span>
<?php
}
?>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
      </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->

    
</body>

</html>
