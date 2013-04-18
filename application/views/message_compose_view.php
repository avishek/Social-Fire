<div id="composeModal" class="modal hide fade" role="dialog" aria-labelledby="composeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Message</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal" action="<?php echo site_url("message/compose"); ?>" method="post">
      <div class="control-group">
        <label class="control-label" for="to_user">To:</label>
        <div class="controls">
          <select id="to_user" name="to_user">
            <?php
              if($friends) {
                foreach ($friends as $key => $row) {
                  echo "<option value='".$row['id']."'>".$row['name']."</option>"; 
                }
              }
            ?>
          </select>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="subject">Subject:</label>
        <div class="controls">
          <input class="input-medium" type="text" id="subject" name="subject">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="content">Content:</label>
        <div class="controls">
          <textarea id="content" name="content" rows="4"></textarea>
        </div>
      </div>
      <div class="control-group pull-right">
        <div class="controls">
          <button type="submit" class="btn">Send</button>
          <button class="btn btn-danger btn-medium" data-dismiss="modal">Discard</button>
        </div>
      </div>
    </form>
  </div>
</div>