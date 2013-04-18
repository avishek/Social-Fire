<?php include('project_all_header_view.php'); ?>

<?php include('project_create_view.php'); ?>

<?php

if($projects) {

	$project_media_body = "";

	foreach($projects as $key => $row) {

		$project_load_url = site_url("project/main/".$row['id']);
		
		if($row['status'] == 0) {
			$label_class = "label label-success pull-right";
			$label_name = "Active";
		} else if ($row['status'] == 1) {
			$label_class = "label pull-right";
			$label_name = "In-active";
		} else {
			$label_class = "label label-important pull-right";
			$label_name = "Closed";
		}

		$project_media_body .= '<div class="media well">
									<div class="media-body">
										<h4 class="media-heading"><a href="'.$project_load_url.'">'.$row['name'].'</a> <span class="'.$label_class.'">'.$label_name.'</span></h4>
										<p><strong>Start date: '.$row['start'].'</strong></p>
										<p><strong>End date: '.$row['end'].'</strong></p>
										<p>'.$row['desc'].'</p>
									</div>
								</div>';
	}
} else {
	$project_media_body = "<div id='noProject'><div class='row-fluid'><strong>Sorry, no projects.</strong></div></div>";
}
?>

<div id="project_body">
	<?php echo $project_media_body; ?>
</div>