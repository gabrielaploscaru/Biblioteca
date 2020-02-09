
<?php 

$book_id = $_GET['id'];

//echo $book_id;


echo '<form action="?add_pictures" method="post" enctype="multipart/form-data">';
echo '<label class="custom-file">
		  <input type="file" id="file" name="files[]">
	  </label>';
echo  '<input type="hidden" name="item_id" value="'.$book_id.'"/>';

echo '<input type="submit"  value="Upload">';
?>