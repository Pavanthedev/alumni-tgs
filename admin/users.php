<?php 
$showAlert = false; 
$showError = false; 
$exists=false;
if($_SERVER["REQUEST_METHOD"] == "POST") {
      
    // Include file which makes the
    // Database Connection.
    include 'db_connect.php';   
    
    $name = $_POST["name"]; 
    $username = $_POST["username"]; 
    $password = $_POST["password"];
    $imgname = $_FILES['file']['name'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");
  
            
    
    $sql = "Select * from users where username='$username'";
    
    $result = mysqli_query($conn, $sql);
    
    $num = mysqli_num_rows($result); 
    
    // This sql query is use to check if
    // the username is already present 
    // or not in our Database
    if($num == 0 && in_array($imageFileType,$extensions_arr)) {
        if($exists==false && move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)) {
            $image_base64 = base64_encode(file_get_contents('upload/'.$name) );
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
             
            $sql = "INSERT INTO `users` ( `name`, 
                `username`, `password`) VALUES ('$name', 
                '$username','$password')";
    
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                $showAlert = true; 
            }
        } 
            
    }// end if 
    
   if($num>0) 
   {
      $exists="Username not available"; 
   } 
    
}
?>

<div class="container-fluid">
	
	<div class="row">
	
	</div>
	<br>
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Name</th>
					<th class="text-center">Username</th>
                    <th class="text-center">Password</th>
					<th class="text-center">Type</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Batch</th>
                    <th class="text-center">Avatar</th>
                    <th class="text-center">Description</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';
 					$type = array("","Admin","Staff","Alumnus/Alumna");
 					$users = $conn->query("SELECT * FROM users order by name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
				 <tr>
				 	<td class="text-center">
				 		<?php echo $i++ ?>
				 	</td>
				 	<td>
				 		<?php echo ucwords($row['name']) ?>
				 	</td>
				 	
				 	<td>
				 		<?php echo $row['username'] ?>
				 	</td>
                     <td>
				 		<?php echo $row['password'] ?>
				 	</td>
				 	<td>
				 		<?php echo $type[$row['type']] ?>
				 	</td>
                     <td>
				 		<?php echo $row['gender'] ?>
				 	</td>
                     <td>
				 		<?php echo $row['batch'] ?>
				 	</td>
                     <td>
				 		<?php echo $row['avatar'] ?>
				 	</td>
                     <td>
				 		<?php echo $row['status'] ?>
				 	</td>
				 	<td>
				 		<center>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary">Action</button>
								  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    
								    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
								  </div>
								</div>
								</center>
				 	</td>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
			</div>
            <?php
    
    if($showAlert) {
    
        echo ' <div class="alert alert-success 
            alert-dismissible fade show" role="alert">
    
            <strong>Success!</strong> Your account is 
            now created and you can login. 
            <button type="button" class="close"
                data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">×</span> 
            </button> 
        </div> '; 
    }
    
    if($showError) {
    
        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert"> 
        <strong>Error!</strong> '. $showError.'
    
       <button type="button" class="close" 
            data-dismiss="alert aria-label="Close">
            <span aria-hidden="true">×</span> 
       </button> 
     </div> '; 
   }
        
    if($exists) {
        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert">
    
        <strong>Error!</strong> '. $exists.'
        <button type="button" class="close" 
            data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> 
        </button>
       </div> '; 
     }
   
?>
			<div class="container mt-3 pt-2">
               <div class="col-lg-12">
                   <div class="card mb-4">
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="col-md-12">
                                    <form action="" id="create_account" method="post">
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Name</label>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">username</label>
                                                <input type="text" class="form-control" name="username" >
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Password</label>
                                                <input type="text" class="form-control" name="password" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Type</label>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        -Please Select-
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#">Admin</a>
                                                        <a class="dropdown-item" href="#">Alumni/Alumnus</a>
                                                        
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Gender</label>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        -Please Select-
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#">Male</a>
                                                        <a class="dropdown-item" href="#">Female</a>
                                                        
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Batch</label>
                                                <input type="input" class="form-control datepickerY" name="batch" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Avatar</label>
                                                <input type='file' name='file' />
                                                
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Short Description</label>
                                                <textarea name="description" id="" cols="30" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div id="msg">
                                            
                                        </div>
                                        <hr class="divider">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button class="btn btn-primary" name="save" type="Submit">Create Account</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                   </div>
               </div>
                
            </div>
		</div>
		</div>

				


	</div>

</div>
<script>
    
   $('.datepickerY').datepicker({
        format: " yyyy", 
        viewMode: "years", 
        minViewMode: "years"
   })
</script>