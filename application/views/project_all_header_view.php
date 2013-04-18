<div id="project_header_bar">
	<div class="row-fluid">
		<div class="span12">
			<a data-toggle="modal" href="#newProjectModal" class="btn btn-primary pull-right">
				<i class="icon-plus"></i>
				Create Project
			</a>
		</div>
		<div class='row-fluid'><div class='span12'></div></div>
	</div>
	<?php

	if(validation_errors()) {
		echo "<div class='row-fluid'><div class='span12'><div class='alert'><button type='button' class='close' data-dismiss='alert'>Close</button>".validation_errors()."</div></div></div>";
	}

	?>
</div>