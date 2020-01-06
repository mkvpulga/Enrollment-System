<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include_once 'includes/connection.php'; 
?>


<div class="container-fluid">
<h6 class="m-0 font-weight-bold text-primary">Unit fee
</h6>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">

     <form action="unit_fee.php" method="POST"  class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control  small" id="search_params" name="search_params" placeholder="Track Code" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" name="searchbtn" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
            <?php
         
      
     
      //retrieve records
  
  if(isset($_POST['searchbtn'])){
    $search_params = "";
      $search_params = $_POST['search_params'];
   //$_POST['course_description'] = "gago";
    $query = "SELECT uf.id as unit_fee_id, uf.amount_per_unit, cou.id as course_id, cou.course_code, cou.course_description, cou.year, cou.semester from unit_fee uf inner join course cou on uf.course_id = cou.id where cou.course_code like  '$search_params%'";
  } else {
    $query = "SELECT uf.id as unit_fee_id, uf.amount_per_unit, cou.id as course_id, cou.course_code, cou.course_description, cou.year, cou.semester from unit_fee uf inner join course cou on uf.course_id = cou.id";
  }
  $query_run = mysqli_query($connection,$query);
      ?>
          </form>
 <form action="unit_fee_edit.php" method="POST" style="float: right;"  >
                    <input type="hidden" name="edit_id" value="<?php echo $row['unit_fee_id']; ?>">
                    <input type="hidden" name="edit_course_id" value="<?php echo $row['course_id']; ?>">
                    <input type="hidden" name="edit_amount_per_unit" value="<?php echo $row['amount_per_unit']; ?>">
                    <input type="hidden" name="edit_subject_description" value="<?php echo $row['subject_description']; ?>"><button  type="submit" name="edit_btn"  class="btn btn-primary"> Add Unit fee</button>
                </form> 
          

             <!-- <button type="button" class="btn btn-primary" data-backdrop="static" style="float: right;" data-toggle="modal" data-target="#addadminprofile">
              Add Unit fee
            </button> -->
    
  </div>

  <div class="card-body">

<?php
  	if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
  		echo '<h2 class="form-control bg-success text-white"> '.$_SESSION['success'].' </h2> ';
  		unset($_SESSION['success']);
  	}

	if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
  		echo '<h2 class="form-control bg-danger text-white"> '.$_SESSION['status'].' </h2> ';
  		unset($_SESSION['status']);
  	}

  	?>
    <div class="table-responsive">
    	
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Track Code </th>
            <th> Track Description </th>
            <th> Grade </th>
            <th>Semester </th>
            <th>Amount Per Unit</th>
            <th>EDIT </th>
            <th>DELETE </th>
            
          </tr>
        </thead>
        <tbody>
     	<?php
     	if(mysqli_num_rows($query_run) > 0){
     		while($row = mysqli_fetch_assoc($query_run)){
    
     			?>
     			<tr>
          <td> <?php  echo $row['course_code']; ?></td>
            <td> <?php  echo $row['course_description']; ?></td>
            <td> <?php  echo $row['year']; ?></td>
            <td> <?php  echo $row['semester']; ?></td>
            <td> <?php  echo $row['amount_per_unit']; ?> </td>
              <td>
                <form action="unit_fee_edit.php" method="POST" >
                    <input type="hidden" name="edit_id" value="<?php echo $row['unit_fee_id']; ?>">
                    <input type="hidden" name="edit_course_id" value="<?php echo $row['course_id']; ?>">
                    <input type="hidden" name="edit_amount_per_unit" value="<?php echo $row['amount_per_unit']; ?>">
                    <input type="hidden" name="edit_subject_description" value="<?php echo $row['subject_description']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-primary"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="unit_fee_code.php" method="post" >
                  <input type="hidden" name="delete_id" value="<?php echo $row['unit_fee_id']; ?>">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            </td>
          </tr>
     		<?php }
     	} else {
     	echo "No Record Found";
     }

     	?>
          
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>