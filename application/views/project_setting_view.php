<?php include('project_setting_edit_view.php'); ?>
<div class="tab-pane active" id="setting">
	<form class="form-horizontal well">
		<div class="control-group">
			<label class="control-label" for="name">Name:</label>
			<div class="controls">
			  <input class="input-medium" type="text" id="name" name="name" value="<?php echo $project['name']; ?>" readonly="">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="creator">Creator:</label>
			<div class="controls">
			  <input class="input-medium" type="text" id="creator" name="creator" value="<?php echo $creator['name']; ?>" readonly="">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="start">Start date:</label>
			<div class="controls">
			    <input class="span10" size="16" type="text" value="<?php echo $project['start']; ?>" readonly="" id="start" name="start">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="end">End date:</label>
			<div class="controls">
			    <input class="span10" size="16" type="text" value="<?php echo $project['end']; ?>" readonly="" id="end" name="end">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="desc">Description:</label>
			<div class="controls">
			  <textarea id="desc" name="desc" rows="5" readonly=""><?php echo $project['desc']; ?></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="status">Status:</label>
			<div class="controls">
				<select id="status" name="status" disabled>
					<option value='0' <?php if($project['status'] == 0) { echo "selected"; }?>>Active</option>
					<option value='1' <?php if($project['status'] == 1) { echo "selected"; }?>>In-active</option>
					<option value='2' <?php if($project['status'] == 2) { echo "selected"; }?>>Closed</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="contributors">Contributors:</label>
			<div class="controls">
				<select id="contributors" name="contributors" multiple="multiple" readonly="">
					<?php
						foreach ($contributors as $row) {
							if($row['cont'] == 1) {
								echo '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
							} else {
								echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
							}
						}
					?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<a data-toggle="modal" href="#editProjectModal" class="btn btn-primary">Edit</a>
			</div>
		</div>
	</form>
</div>