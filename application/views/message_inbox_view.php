<?php include("message_navbar_view.php"); ?>

<?php include('message_compose_view.php'); ?>

<?php

if($inbox) {

  $message_view_modal = "";
  $table_body_rows = "";

  foreach($inbox as $key => $row) {

    $delete_url = site_url("message/delete/".$row['id']);
    
    $message_view_modal .= 
    '<div id="viewModal'.$row['id'].'" class="modal hide fade" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Message</h3>
      </div>
      <div class="modal-body">
        <h4>From</h4>
        <p>'.$row['name'].'</p>
        <h4>Subject</h4>
        <p>'.$row['subject'].'</p>
        <h4>Content</h4>
        <p>'.$row['content'].'</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger btn-medium" data-dismiss="modal">Close</button>
      </div>
    </div>';

    $table_body_rows .= "<div class='row-fluid'>"."<div class='span3'>".$row['name']."</div>"."<div class='span5'>".$row['subject']."</div>"."<div class='span2'>".$row['date_time']."</div>"."<div class='span2'>"."<div class='btn-group'>"."<a data-toggle='modal' href='#viewModal".$row['id']."' class='btn btn-small btn-primary'>View</a>"."<a class='btn btn-small' href='".$delete_url."'>Delete</a>"."</div>"."</div>"."</div>";
  }

  echo $message_view_modal.
        "<div id='messagePreview'><div class='row-fluid'><div class='span12'></div></div><div class='row-fluid'><div class='span3'><strong>From</strong></div><div class='span5'><strong>Subject</strong></div><div class='span2'><strong>Date/Time</strong></div><div class='span2'><strong>Action</strong></div></div></div>".
           $table_body_rows.
        "</div>";

} else {

  echo "<div id='messagePreview'><div class='row-fluid'><div class='span12'></div></div><div class='row-fluid'><strong>Sorry, no messages in inbox.</strong></div></div>";
}
?>