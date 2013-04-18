<div>
  <a data-toggle="modal" href="#composeModal" class="btn btn-medium btn-danger">Compose</a>
  <div class="btn-group pull-right">
    <button class="btn dropdown-toggle" data-toggle="dropdown">
      <a href="<?php echo site_url('message'); ?>">Inbox</a>
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li>
        <a href="<?php echo site_url('message'); ?>">Inbox</a>
      </li>
      <li>
        <a href="<?php echo site_url('message/sent'); ?>">Sent</a>
      </li>
    </ul>
  </div>
</div>