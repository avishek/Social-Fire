<div id="editProjectModal" class="modal hide fade" role="dialog" aria-labelledby="editProjectModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Project</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" action="<?php echo site_url("project/update/".$project['id']); ?>" method="post">
      <div class="control-group">
        <label class="control-label" for="name">Name:</label>
        <div class="controls">
          <input class="input-medium" type="text" id="name" name="name" value="<?php echo $project['name']; ?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="creator">Creator:</label>
        <div class="controls">
          <input class="input-medium" type="text" id="creator" name="creator" value="<?php echo $creator['name']; ?>" readonly="">
          <input type="hidden" id="creator_id" name="creator_id" value="<?php echo $creator['id']; ?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="start">Start date:</label>
        <div class="controls">
          <div class="input-append date datepicker" id="dp3" data-date="<?php echo $project['start']; ?>" data-date-format="dd-mm-yyyy">
            <input class="span10" size="16" type="text" value="<?php echo $project['start']; ?>" readonly="" id="start" name="start">
            <span class="add-on"><i class="icon-calendar"></i></span>
          </div>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="end">End date:</label>
        <div class="controls">
          <div class="input-append date datepicker" id="dp4" data-date="<?php echo $project['end']; ?>" data-date-format="dd-mm-yyyy">
            <input class="span10" size="16" type="text" value="<?php echo $project['end']; ?>" readonly="" id="end" name="end">
            <span class="add-on"><i class="icon-calendar"></i></span>
          </div>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="desc">Description:</label>
        <div class="controls">
          <textarea id="desc" name="desc" rows="5"><?php echo $project['desc']; ?></textarea>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="status">Status:</label>
        <div class="controls">
          <select id="status" name="status">
            <option value='0' <?php if($project['status'] == 0) { echo "selected"; }?>>Active</option>
            <option value='1' <?php if($project['status'] == 1) { echo "selected"; }?>>In-active</option>
            <option value='2' <?php if($project['status'] == 2) { echo "selected"; }?>>Closed</option>
          </select>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="contributors[]">Contributors:</label>
        <div class="controls">
          <select id="contributors" name="contributors[]" multiple="multiple">
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
      <div class="control-group pull-right">
        <div class="controls">
          <button type="submit" class="btn">Update</button>
          <button class="btn btn-danger btn-medium" data-dismiss="modal">Discard</button>
        </div>
      </div>
    </form>
  </div>
</div>