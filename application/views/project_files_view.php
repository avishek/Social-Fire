<div class="tab-pane" id="files">

	<div class="row-fluid">
		<div class="span12">
			<form class="form-inline" action="<?php echo site_url("upload/do_upload");?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
				<input type="file" name="userfile" id="userfile" style="display:none">
				<input type="hidden" name="projectId" if="projectId" value="<?php echo $project['id']; ?>">
				<div class="input-prepend">
					<a class="btn" onclick="$('input[id=userfile]').click();">Browse File</a>
					<input id="namesake" class="input-large" type="text">
				</div>
				<script type="text/javascript">
					$('input[id=userfile]').change(function() {
						$('#namesake').val($(this).val());
					});
				</script>
				<button type="submit" class="btn-primary">Upload</button>
			</form>
		</div>
	</div>

<?php

	$table_file_info = "";
	if($files) {

		foreach ($files as $files_row) {
			
			$file_delete_url = site_url("upload/deleteFile/".$files_row['file_id']);

			if($files_row['file_mine'] == 1) {
				$open_tag = "<tr class='error'>";
			} else {
				$open_tag = "<tr>";
			}

			$table_file_info .= $open_tag.'<td>'.$files_row['file_name'].'</td>
                            <td>'.$files_row['file_type'].'</td>
                            <td>'.$files_row['file_size'].'</td>
                            <td>'.$files_row['file_creator_name'].'</td>
                            <td>'.$files_row['file_upload_datetime'].'</td>
                            <td>
                              <a href="'.$file_delete_url.'" class="btn btn-small"><i class="icon-trash"></i> Delete File</a>
                            </td>
                          </tr>';
		}

		echo '<table class="table" id="filesTable">
            <thead>
              <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Size/KB</th>
                <th>Creator</th>
                <th>Upload Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>'.
             $table_file_info 
            .'</tbody>
          </table>';
	} else {
		echo "<div id='messagePreview'><div class='row-fluid'><div class='span12'></div></div><div class='row-fluid'><strong>Sorry, no files have been uploaded or shared.</strong></div></div>";
	}
?>

</div>