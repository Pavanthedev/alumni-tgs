<?php
include('db_connect.php');
session_start();

$user = $conn->query("SELECT * FROM users where id =" . $_GET['id']);

while ($row = $user->fetch_assoc()) :
?>
	<div class="container-fluid">
		<div id="msg"></div>
		<form action="" id="manage-user">
			<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id'] : '' ?>">
			<div class="form-group">
				<label class="font-weight-bold" for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control" value="<?php echo $row['name'] ?>" required>
			</div>
			<div class="form-group">
				<label class="font-weight-bold" for="username">Username</label>
				<input type="text" name="username" id="username" class="form-control" value="<?php echo $row['username'] ?>" required autocomplete="off">
			</div>
			<div class="form-group">
				<label class="font-weight-bold" for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
				<?php if (isset($meta['id'])) : ?>
					<small><i>Leave this blank if you dont want to change the password.</i></small>
				<?php endif; ?>
			</div>
			
					<div class="form-group">
						<label class="font-weight-bold" for="type">User Type: <?php if($row['type'] == 1){
							echo 'Admin';
						}
						if($row['type'] == 2){
							echo 'Staff';
						}else{
							echo 'Alumni/Alumnus';
						}
						?></label><br>
						
						Change to:<select name="type" id="type" class="custom-select">
							<option value="1">Admin</option>
							<option value="2" >Staff</option>
							<option value="3" >Alumni/Aluminus</option>

						</select>
					</div>
					<div class="form-group">
						<label class="font-weight-bold" for="type">Gender:  <?php echo $row['gender'] ?></label><br>
						Change to:<select id="gender" name="gender" class="custom-select">
							<option value="Female" <?php echo $row['gender'] == 'Female' ?>>Female</option>
							<option value="Male" <?php echo $row['gender'] == 'Male' ?>>Male</option>
						</select>
					</div>
				
			<div class="col-md-4">
				<label class="font-weight-bold" for="" class="control-label">Short Description</label>
				<textarea name="description" id="" cols="30" rows="3" class="form-control" name="description"><?php echo $row['status'] ?></textarea>
			</div>

		</form>
	</div>
<?php endwhile; ?>
<style>
	.masthead {
		min-height: 23vh !important;
		height: 23vh !important;
	}

	.masthead:before {
		min-height: 23vh !important;
		height: 23vh !important;
	}

	img#cimg {
		max-height: 10vh;
		max-width: 6vw;
	}
</style>


<script>
	$('#manage-user').submit(function(e) {
		e.preventDefault();
		start_load()
		$.ajax({
			url: 'ajax.php?action=save_user',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data successfully saved", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)
				} else {
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_load()
				}
			}
		})
	})
</script>