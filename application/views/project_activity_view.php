<div class="tab-pane" id="activity">

	<div class="row-fluid">
		<div class="span12">
			<form action="<?php echo site_url("comment/insert/".$project['id']); ?>" method="post">
				<fieldset>
					<input type="hidden" value="" name="activityId" id="activityId">
					<textarea rows="5" class="input-block-level" name="msg" id="msg"></textarea>
					<button type="submit" class="btn btn-success pull-right">Comment</button>
				</fieldset>
			</form>
		</div>
	</div>

	<style type="text/css">
		.media-self {
			padding-top: 15px;
			border-top: 1px solid rgb(179, 176, 176);
		}
		.well-self {
			padding: 7px;
			margin-bottom: 10px;
		}
		.p-self {
			margin: 0px;
		}
	</style>
	
	<script type="text/javascript">
		$(document).on('ready', function() {
			$('input[type="checkbox"]').on('click', function(event) {
				
				if($(this).is(':checked'))
				{
					$('input[type="checkbox"]').prop('checked', false);
					$(this).prop('checked',true);
					$('#activityId').val($(this).val());
				}
				else
				{
					$('#activityId').val('');
					$(this).prop('checked',false);
				}
			})
		});
	</script>
	
<?php 

	$activity_list_code = "";
	if($activities) {

		foreach ($activities as $activity_value) {

			$comments_body = "";
			foreach ($activity_value['activity_comments'] as $comment_value) {
				
					$comments_body .= '<div class="well well-self">
											<p class="p-self"><strong>'.$comment_value['comment_user_name'].'</strong> '.$comment_value['comment_msg'].'</p>
										</div>';
			}

			$activity_text = "";
			if($activity_value['activity_type'] == 1) {

				$activity_text = '<p class="media-heading"><strong>'.$activity_value['activity_user_name'].'</strong> created a '.$activity_value['activity_subject'].' named <strong>'.$activity_value['activity_subject_name'].'</strong> at '.date('F/j/Y', strtotime($activity_value['activity_date_time'])).'.</p>';
			} else if($activity_value['activity_type'] == 2) {

				$activity_text = '<p class="media-heading"><strong>'.$activity_value['activity_user_name'].'</strong> updated a '.$activity_value['activity_subject'].' named <strong>'.$activity_value['activity_subject_name'].'</strong> at '.date('F/j/Y', strtotime($activity_value['activity_date_time'])).'.</p>';
			} else {

				$activity_text = '<p class="media-heading"><strong>'.$activity_value['activity_user_name'].'</strong> deleted a '.$activity_value['activity_subject'].' named <strong>'.$activity_value['activity_subject_name'].'</strong> at '.date('F/j/Y', strtotime($activity_value['activity_date_time'])).'.</p>';
			}

			$activity_list_code .= '<div class="media media-self">
								  <input type="checkbox" value="'.$activity_value['activity_id'].'" class="pull-left">
								  <div class="media-body">'.
								   $activity_text.$comments_body 
								 .'</div>
								</div>';

		}

		echo '<div class="row-fluid">
				<div class="span12">'.
					$activity_list_code	
				.'</div>
			</div>';

	} else {
		echo "<div id='messagePreview'><div class='row-fluid'><div class='span12'></div></div><div class='row-fluid'><strong>Sorry, no activites have been recorded for this project.</strong></div></div>";
	}

?>

</div>