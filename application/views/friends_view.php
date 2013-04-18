<form action="<?php echo site_url("friend/search"); ?>" method="post">
	<div class="form-inline" >
		<input class="input-medium" id="searchItem" name="searchItem" type="text">
		<select class="span2" name="opt" id="opt">
			<option value="1" selected>All</option>
		  	<option value="2">Name</option>
		  	<option value="3">Email</option>
		  	<option value="4">Matric</option>
		</select>
		<button type="submit" class="btn">Search</button>
	</div>
</form>

<?php

if($result) {
	foreach($result as $key => $row) {
		$url_add = site_url("friend/add/".$row['id']);
		$url_del = site_url("friend/delete/".$row['id']);
		if($row['friends'] == 1) { 
		 	echo "<div class='well'><a href='#'>".$row["name"]." (".$row["matric"].") (".$row['email'].")"."</a><div class='btn-group pull-right'><a class='btn dropdown-toggle' data-toggle='dropdown' href='#'>Following <span class='caret'></span></a><ul class='dropdown-menu'><li><a href='#'><i class='icon-check'></i> Following</a></li><li><a href='".$url_del."'><i class='icon-trash'></i> Don't Follow</a></li></ul></div></div>";
	 	} else {
	 		echo "<div class='well'><a href='#'>".$row["name"]." (".$row["matric"].") (".$row['email'].")"."</a><a href='".$url_add."' class='btn pull-right'><i class='icon-plus'></i> Follow</a></div>";
	 	}
	}
} else {
	echo "Sorry, no friends found. Please use search.";
}

?>