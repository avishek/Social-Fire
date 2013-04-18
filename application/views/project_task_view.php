<?php include('project_task_create_view.php'); ?>
<script type="text/javascript" src="<?php echo base_url("assets/js/taskTable.js"); ?>"></script>
<div class="tab-pane" id="task">

	<div class="row-fluid">
		<div class="span12">
			<a data-toggle="modal" href="#newTaskModal" class="btn btn-small btn-primary">
				<i class="icon-plus"></i>
				Create Task
			</a>
			<div class="pull-right">
				<select class="input-small" id="trows">
					<option value="all" selected>All</option>
					<option value="open">Open</option>
					<option value="priority">Priority</option>
					<option value="closed">Closed</option>
				</select>
			</div>
		</div>
	</div>

<?php

  $task_table_body = "";
  if($tasks) {

    $task_view_modal = "";
    $task_edit_modal = "";

    foreach ($tasks as $row) {
      $delete_url = site_url("task/delete/".$project['id']."/".$row['task_id']);
      
      if($row['task_status'] == 0) {
        $open_tag = "<tr>";
        $status_value = "Open";
      } else if($row['task_status'] == 1) {
        $open_tag = "<tr class='error'>";
        $status_value = "Priority";
      } else {
        $open_tag = "<tr class='info'>";
        $status_value = "Closed";
      }

      $assigned_to_names = "";
      foreach ($row['task_assigned_to'] as $value) {
        if($value['task_asd'] == 1) {
          $assigned_to_names .= $value['name']."  ";
        }
      }
      
      $task_table_body .= $open_tag.'<td>'.$row['task_name'].'</td>
                            <td>'.$row['task_start_date'].'</td>
                            <td>'.$row['task_end_date'].'</td>
                            <td>'.$status_value.'</td>
                            <td>'.$row['task_creator'].'</td>
                            <td>'.$assigned_to_names.'</td>
                            <td>
                              <a data-toggle="modal" href="#viewTaskModal'.$row['task_id'].'" href="#" class="btn btn-small"><i class="icon-eye-open"></i></a>
                              <a data-toggle="modal" href="#editTaskModal'.$row['task_id'].'" href="#" class="btn btn-small"><i class="icon-pencil"></i></a>
                              <a href="'.$delete_url.'" class="btn btn-small"><i class="icon-trash"></i></a>
                            </td>
                          </tr>';

      $task_view_modal .= '<div id="viewTaskModal'.$row['task_id'].'" class="modal hide fade" role="dialog" aria-labelledby="viewTaskModalLabel'.$row['task_id'].'" aria-hidden="true" style="display: none;">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h3>Task</h3>
                              </div>
                              <div class="modal-body">
                                <p><strong>Name:</strong> '.$row['task_name'].'</p>
                                <p><strong>Start Date:</strong> '.$row['task_start_date'].'</p>
                                <p><strong>End Date:</strong> '.$row['task_end_date'].'</p>
                                <p><strong>Creator:</strong> '.$row['task_creator'].'</p>
                                <p><strong>Status:</strong> '.$status_value.'</p>
                                <p><strong>Assigned to:</strong> '.$assigned_to_names.'</p>
                                <p><strong>Description:</strong></p>
                                <p>'.$row['task_desc'].'</p>
                              </div>
                            </div>';

      $task_edit_url = site_url("task/update/".$project['id']."/".$row['task_id']);
      
      $opt_status_statements = "";
      if($row['task_status'] == 0) {
        $opt_status_statements .= '<option value="0" selected>Open</option>';
      } else {
        $opt_status_statements .= '<option value="0">Open</option>';
      }
      if($row['task_status'] == 1) {
        $opt_status_statements .= '<option value="1" selected>Priority</option>';
      } else {
        $opt_status_statements .= '<option value="1">Priority</option>';
      }
      if($row['task_status'] == 2) {
        $opt_status_statements .= '<option value="2" selected>Closed</option>';
      } else {
        $opt_status_statements .= '<option value="2">Closed</option>';
      }

      $opt_asd_statements = "";
      foreach ($row['task_assigned_to'] as $val) {
        if($val['task_asd'] == 1) {
          $opt_asd_statements .= '<option value="'.$val['id'].'" selected>'.$val['name'].'</option>';
        } else {
          $opt_asd_statements .= '<option value="'.$val['id'].'">'.$val['name'].'</option>';
        }
      }

      $task_view_modal .= '<div id="editTaskModal'.$row['task_id'].'" class="modal hide fade" role="dialog" aria-labelledby="editTaskModalLabel'.$row['task_id'].'" aria-hidden="true" style="display: none;">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h3>Task</h3>
                              </div>
                              <div class="modal-body">
                                <form class="form-horizontal" action="'.$task_edit_url.'" method="post">
                                  <div class="control-group">
                                    <label class="control-label" for="name">Name:</label>
                                    <div class="controls">
                                      <input class="input-medium" type="text" id="name" name="name" value="'.$row['task_name'].'">
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="creator">Creator:</label>
                                    <div class="controls">
                                      <input class="input-medium" type="text" id="creator" name="creator" value="'.$row['task_creator'].'" readonly="">
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="desc">Description:</label>
                                    <div class="controls">
                                      <textarea id="desc" name="desc" rows="5">'.$row['task_desc'].'</textarea>
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="start">Start date:</label>
                                    <div class="controls">
                                      <div class="input-append date datepicker" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
                                        <input class="span10" size="16" type="text" value="'.$row['task_start_date'].'" readonly="" id="start" name="start">
                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="end">End date:</label>
                                    <div class="controls">
                                      <div class="input-append date datepicker" id="dp4" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
                                        <input class="span10" size="16" type="text" value="'.$row['task_end_date'].'" readonly="" id="end" name="end">
                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="status">Status:</label>
                                    <div class="controls">
                                      <select id="status" name="status">'.
                                        $opt_status_statements
                                      .'</select>
                                    </div>
                                  </div>
                                  <div class="control-group">
                                    <label class="control-label" for="assigned_to[]">Assigned to:</label>
                                    <div class="controls">
                                      <select id="assigned_to" name="assigned_to[]" multiple="multiple">'.
                                        $opt_asd_statements  
                                      .'</select>
                                    </div>
                                  </div>
                                  <div class="control-group pull-right">
                                    <div class="controls">
                                      <button type="submit" class="btn">Edit</button>
                                      <button class="btn btn-danger btn-medium" data-dismiss="modal">Discard</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>';
    }

    echo $task_view_modal;
    echo '<table class="table" id="taskTable">
            <thead>
              <tr>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Creator</th>
                <th>Assigned to</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>'.
             $task_table_body 
            .'</tbody>
          </table>';
  } else {
    echo "<div id='messagePreview'><div class='row-fluid'><div class='span12'></div></div><div class='row-fluid'><strong>Sorry, no tasks have been created.</strong></div></div>";
  }

?>

</div>