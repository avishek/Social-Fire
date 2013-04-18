<div id="newTaskModal" class="modal hide fade" role="dialog" aria-labelledby="newTaskModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Task</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" action="<?php echo site_url("task/create/".$project['id']); ?>" method="post">
      <div class="control-group">
        <label class="control-label" for="name">Name:</label>
        <div class="controls">
          <input class="input-medium" type="text" id="name" name="name">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="creator">Creator:</label>
        <div class="controls">
          <input class="input-medium" type="text" id="creator" name="creator" value="<?php echo $name; ?>" readonly="">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="desc">Description:</label>
        <div class="controls">
          <textarea id="desc" name="desc" rows="5"></textarea>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="start">Start date:</label>
        <div class="controls">
          <div class="input-append date datepicker" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
            <input class="span10" size="16" type="text" value="12-02-2012" readonly="" id="start" name="start">
            <span class="add-on"><i class="icon-calendar"></i></span>
          </div>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="end">End date:</label>
        <div class="controls">
          <div class="input-append date datepicker" id="dp4" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
            <input class="span10" size="16" type="text" value="12-02-2012" readonly="" id="end" name="end">
            <span class="add-on"><i class="icon-calendar"></i></span>
          </div>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="status">Status:</label>
        <div class="controls">
          <select id="status" name="status">
            <option value='0' selected>Open</option>
            <option value='1'>Priority</option>
            <option value='2'>Closed</option>
          </select>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="assigned_to[]">Assigned to:</label>
        <div class="controls">
          <select id="assigned_to" name="assigned_to[]" multiple="multiple">
            <?php
              foreach ($contributors as $row) {
                if($row['cont'] == 1) {
                  echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
              }
            ?>
          </select>
        </div>
      </div>
      <div class="control-group pull-right">
        <div class="controls">
          <button type="submit" class="btn">Create</button>
          <button class="btn btn-danger btn-medium" data-dismiss="modal">Discard</button>
        </div>
      </div>
    </form>
  </div>
</div>