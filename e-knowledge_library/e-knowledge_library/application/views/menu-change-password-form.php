		<form class="form-horizontal" role="form" action="" method="post">
		  
		  <div class="form-group <?php if( $CurrentPassword == 'false' ){ echo ' has-error';} ?>">
			<label class="col-sm-4 control-label">Current password</label>
			<div class="col-sm-6">
			  <input type="password" class="form-control" name="CurrentPassword" placeholder="Current password">
			</div>
		  </div>
		  
		  <div class="form-group <?php if( $inputPassword == 'false' ){ echo ' has-error';} ?>">
			<label for="inputPassword" class="col-sm-4 control-label">Create a new password</label>
			<div class="col-sm-6">
			  <input type="password" class="form-control" name="inputPassword" placeholder="New Password">
			</div>
		  </div>
		  
		  <div class="form-group <?php if( $ConfirmPassword == 'false' ){ echo ' has-error';} ?>">
			<label for="ConfirmPassword" class="col-sm-4 control-label">Confirm your new password</label>
			<div class="col-sm-6">
			  <input type="password" class="form-control" name="ConfirmPassword" placeholder="Confirm your new password">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="submit" class="col-sm-4 control-label"></label>
			<div class="col-sm-6">
			  <button class="btn btn-primary" type="submit">Save</button>
			</div>
		  </div>
		  
		  
		  
		</form>	