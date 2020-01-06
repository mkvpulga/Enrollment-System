<?php
session_start();
include('includes/header.php'); 
// include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary"> Type of School
            
    </h6>
  </div>

  <div class="card-body">
  	<?php
  	
  	
			
  	
  	?>
    <form action="configuration_code.php" method="POST" enctype="multipart/form-data">
         <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
             
             <div class="form-group">
              
                 <input type="checkbox" name="is_junior" value="1" > Junior High School <br>
               <input type="checkbox" name="is_senior" value="1" > Senior High School &nbsp;
            </div>
            
            <!-- <a href ="announcement.php" class="btn btn-danger"> CANCEL </a> -->
            <button type="submit" name="createbtn" class="btn btn-primary"> Update </button>
          </form>
            
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->



<?php
include('includes/scripts.php');
// include('includes/footer.php');
?>