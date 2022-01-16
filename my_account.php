<?php
$showAlert = false; 
$showError = false; 
$exists=false;
if($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'admin/db_connect.php';
    $name = $_POST['name'];
    $Curr_work = $_POST['currentlywork'];
    $status = $_POST['status'];
    $password = $_POST['password'];
    $filename =basename($_FILES["fileToUpload"]["name"]);
    $target_dir = "admin/assets/uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;



    if(!empty($password)){
        $change_password = "update users set password = '$password' where name = '$name'";
        $result = mysqli_query($conn, $change_password);
    }
    $update_acc = "update users set status = '$status', Curr_work = '$Curr_work', avatar = '$filename' where name = '$name'";
    $result = mysqli_query($conn, $update_acc);

    if($result) {
        $showAlert = true;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          
        } 
      }
    

    
    
    

}
?>
<style>
    .masthead{
        min-height: 23vh !important;
        height: 23vh !important;
    }
     .masthead:before{
        min-height: 23vh !important;
        height: 23vh !important;
    }
    img#cimg{
        max-height: 10vh;
        max-width: 6vw;
    }
</style>
        <header class="masthead">
            <div class="container-fluid h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end mb-4 page-title">
                    	<h3 class="ext-white">Manage Account</h3>
                        <hr class="divider my-4" />

                    <div class="col-md-12 mb-2 justify-content-center">
                    </div>                        
                    </div>
                    
                </div>
            </div>
        </header>
            <div class="container mt-3 pt-2">
               <div class="col-lg-12">
                   <div class="card mb-4">
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="col-md-12">
                                    <form action="" id="update_account" method="POST" enctype="multipart/form-data">
                                        <?php 
                                        $name = $_SESSION['login_name'];
                                        $user_details = $conn->query("SELECT * from users where name = '$name'");
                                        $i = 1;
                                        while($row = $user_details->fetch_assoc()):
                                        ?>
                                        <div class="row form-group">
                                            
                                            <div class="col-md-4">
                                            <label for="" class="control-label">Name</label>
                                            <input name="name" type="text" value="<?php echo $row['name'] ?>" class="form-control" readonly="readonly">
                                            </div>
                                            <div class="col-md-4">
                                            <label for="" class="control-label">Username</label>
                                            <input name="username" type="text" value="<?php echo $row['username'] ?>" class="form-control" readonly="readonly">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Gender</label>
                                                <input name="gender" type="text" value="<?php echo $row['gender'] ?>" class="form-control" readonly="readonly">
                                                </div>
                                            
                                        </div>
                                        <div class="row form-group">
                                        <div class="col-md-4">
                                                <label for="" class="control-label">Batch</label>
                                                <input name="batch" type="text" value="<?php echo $row['batch'] ?>" class="form-control" readonly="readonly">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Currently Working/Studying: </label>
                                                <input name="currentlywork" value="<?php echo $row['Curr_work'] ?>" type="text" class="form-control"  >
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                        <?php
                                                $fpath = 'admin/assets/uploads';
                                                $name = $_SESSION['login_name'];
                                                $alumni = $conn->query("SELECT * from users where type = '3' && name='$name'");
                                                while($row = $alumni->fetch_assoc()):
                                            ?>
                                            <div class="col-md-5">
                                                
                                                <img src="<?php echo $fpath.'/'.$row['avatar'] ?>" class="img-thumbnail" alt="user profile pic">
                                                <br>
                                                <input type="file" name="fileToUpload" id="fileToUpload">
                                            </div>  
                                            
                                            <div class="col-md-5">
                                                <label for="" class="control-label">Description</label>
                                                <input name="status" value ="<?php echo $row['status'] ?>" id="" cols="30" rows="3" class="form-control"></input>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                             
                                            <div class="col-md-4">
                                                <label for="" class="control-label">Password</label>
                                                <input type="password" class="form-control" name="password">
                                                <small><i>Leave this blank if you dont want to change your password</i></small>
                                            </div>
                                        </div>
                                        <div id="msg">
                                            
                                           </div>
                                        <hr class="divider">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button class="btn btn-primary" type="submit">Update Account</button>
                                            </div>
                                        </div>
                                        <?php endwhile; ?>  
                                    <?php endwhile; ?>
                                    </form>
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
   $('.select2').select2({
    placeholder:"Please Select Here",
    width:"100%"
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