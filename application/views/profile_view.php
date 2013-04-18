<h4>Profile details</h4>
<form class="well form-horizontal">
	<div class="control-group">
		<label class="control-label" for="name">Name</label>
		<div class="controls">
			<input type="text" id="name" name="name" placeholder="Name" value="<?php echo $name; ?>" disabled>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="matric">Matriculation Number</label>
		<div class="controls">
			<input type="text" id="matric" name="matric" placeholder="U012345Z" value="<?php echo $matric; ?>" disabled>
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
			<input type="password" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>" disabled>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<a href="<?php echo site_url("profile/edit"); ?>" class="btn btn-primary">Edit</a>
			<a href="<?php echo site_url("home"); ?>" class="btn btn-danger">Cancel</a>
		</div>
	</div>
</form>