<?php 

$book_id = $_GET['id'];

//echo $book_id;
echo '<form action="?add_pictures" method="post" enctype="multipart/form-data">';
echo '<label class="custom-file">
		  <input type="file" id="file" class="custom-file-input" name="files[]">
		  <span class="custom-file-control"></span>
	  </label>';
echo  '<input type="hidden" name="item_id" value="'.$book_id.'"/>';

echo '<input type="submit" class="btn btn-default" value="Upload">';