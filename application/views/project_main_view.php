<div id="project_main">
	<?php
	
	if(validation_errors()) {
		echo "<div class='row-fluid'><div class='span12'><div class='alert'><button type='button' class='close' data-dismiss='alert'>Close</button>".validation_errors()."</div></div></div>";
	}

	?>
	<ul class="nav nav-tabs" data-tabs="tabs">
		<li class="active">
			<a data-toggle="tab" href="#setting">Settings</a>
		</li>
		<li>
			<a data-toggle="tab" href="#task">Tasks</a>
		</li>
		<li>
			<a data-toggle="tab" href="#activity">Activity</a>
		</li>
		<li>
			<a data-toggle="tab" href="#files">Files</a>
		</li>
	</ul>
	<div class="tab-content">
		<?php 
		include('project_setting_view.php'); 
		include('project_task_view.php');
		include('project_activity_view.php');
		include('project_files_view.php');
		?>		
	</div>
</div>