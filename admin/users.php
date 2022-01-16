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
    $type = $_POST["type"];
    $gender = $_POST["gender"];
    $batch = $_POST["batch"];
    $description = $_POST["description"];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
        $folder = "image/".$filename;
                
    
    $sql = "Select * from users where username='$username'";
    
    $result = mysqli_query($conn, $sql);
    
    $num = mysqli_num_rows($result); 
    
    // This sql query is use to check if
    // the username is already present 
    // or not in our Database
    if($num == 0 ) {
        if($exists==false) {
            
            $sql = "INSERT INTO `users` ( `name`, 
                `username`, `password`, `type`, `gender`, `batch`, `status`, `avatar`) VALUES ('$name', 
                '$username','$password', '$type', '$gender', '$batch', '$description', '$filename')";
    
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
                                    <form action="" id="create_account" method="POST" enctype="multipart/form-data">
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
                                            <div class="col-md-5">
                                                <label for="" class="control-label">Batch</label>
                                                <input type="input" class="form-control datepickerY" name="batch" required>
                                            </div>
                                            <div class="col-md-5">
                                                    <label for="" class="control-label">Type</label>
                                                    
                                                    <div class="col-md-4"> 
                                                        <select id="type" name="type" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                      
                                                            <option value="0" >--Select type--</option>
                                                            <option value="1">Admin</option>
                                                            <option value="2">Staff</option>
                                                            <option value="3">Alumni/Alumnus</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="col-md-4">
                                                    <label for="" class="control-label">Gender</label>
                                                
                                                    <div class="col-md-4">
                                                        
                                                        <select id="gender" name="gender" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                      
                                                            <option value="0">--Select Gender--</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>   
                                                        </select>
                                                        
                                                    </div>    
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="" class="control-label">Image</label>
                                                <input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
                                            </div>
                                            <div class="form-group">
                                                <img src="<?php echo is_file('assets/uploads/gallery/img_') ?>" alt="" id="cimg">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Short Description</label>
                                                <textarea name="description" id="" cols="30" rows="3" class="form-control" name="description"></textarea>
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
   function displayImg(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        	$('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>