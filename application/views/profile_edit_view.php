<h4>Profile details</h4>
<form class="well form-horizontal" action="<?php echo site_url("profile/edit"); ?>" method="post">
	<div class="control-group">
		<label class="control-label" for="name">Name</label>
		<div class="controls">
			<input type="text" id="name" name="name" placeholder="Name" value="<?php echo $name; ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="matric">Matriculation Number</label>
		<div class="controls">
			<input type="text" id="matric" name="matric" placeholder="U012345Z" value="<?php echo $matric; ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="email">Email</label>
		<div class="controls">
			<input type="text" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>" disabled>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password">Password</label>
		<div class="controls">
			<input type="password" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="c_password">Confirm Password</label>
		<div class="controls">
			<input type="password" id="c_password" name="c_password" placeholder="Confirm Password" value="<?php echo $password; ?>">
			<span class="help-inline"><?php echo form_error('c_password'); ?></span>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-primary">Update</button>
			<a href="<?php echo site_url("profile"); ?>" class="btn btn-danger">Cancel</a>
		</div>
	</div>
</form>