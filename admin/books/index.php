<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/biblioteca/includes/navbar.html.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/biblioteca/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/biblioteca/includes/access.inc.php';


include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/db.inc.php';



$sql = 'SELECT id, bookname, bookautor, filename, mimetype, description, cover_url FROM book';
$result = mysqli_query($link, $sql);
if (!$result)
{
  $error = 'Database error fetching stored files.';
  include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/error.html.php';
  exit();
}

$files = array();
while ($row = mysqli_fetch_array($result))
{
  $files[] = array(
      'id' => $row['id'],
	  'bookname' => $row['bookname'],
	  'bookautor' =>$row['bookautor'],
      'filename' => $row['filename'],
      'mimetype' => $row['mimetype'],
      'description' => $row['description'],
	  'cover_url' => $row['cover_url']);
}




if (isset($_POST['action']) and $_POST['action'] == 'upload')
{
  // Bail out if the file isn't really an upload
  if (!is_uploaded_file($_FILES['upload']['tmp_name']))
  {
    $error = 'There was no file uploaded!';
    include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/error.html.php';
	exit();
  }
  
  
  
  $uploadfile = $_FILES['upload']['tmp_name'];
  $uploadname = $_FILES['upload']['name'];
  $uploadtype = $_FILES['upload']['type'];
  $uploaddesc = $_POST['desc'];
  $uploadbname = $_POST['bname'];
  $uploadautor = $_POST['bauth'];
  
  if($_FILES['upload']['size'] >= 1000000) {
	  echo "Fisierul are dimensiune prea mare";
	  exit();
  }
  
  $uploaddata = file_get_contents($uploadfile);
  
  include $_SERVER['DOCUMENT_ROOT'] .'/biblioteca/includes/db.inc.php';
 
  // Prepare user-submitted values for safe database insert
  $uploadname = mysqli_real_escape_string($link, $uploadname);
  $uploadtype = mysqli_real_escape_string($link, $uploadtype);
  $uploaddesc = mysqli_real_escape_string($link, $uploaddesc);
  $uploaddata = mysqli_real_escape_string($link, $uploaddata);
  $uploadbname = mysqli_real_escape_string($link, $uploadbname);
  $uploadautor = mysqli_real_escape_string($link, $uploadautor);
  
  
  $sql = "INSERT INTO book SET
      filename = '$uploadname',
      mimetype = '$uploadtype',
      description ='$uploaddesc',
      filedata = '$uploaddata',
	  bookname = '$uploadbname',
	  bookautor = '$uploadautor'";

  
  if (!mysqli_query($link, $sql))
  {
    $error = 'Database error storing file!';
    include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/error.html.php';
    exit();
  }
  
  header('Location: .');
  exit();
}

if (isset($_GET['action']) and
    ($_GET['action'] == 'view' or $_GET['action'] == 'download') and
    isset($_GET['id']))
{
 
  include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/db.inc.php';
  
  $id = mysqli_real_escape_string($link, $_GET['id']);
  
  $sql = "SELECT bookname, bookautor, filename, mimetype, filedata
      FROM book
      WHERE id = '$id'";
  $result = mysqli_query($link, $sql);
  if (!$result)
  {
    $error = 'Database error fetching requested file.';
    include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/error.html.php';
    exit();
  }
  
  $file = mysqli_fetch_array($result);
  if (!$file)
  {
    $error = 'File with specified ID not found in the database!';
    include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/error.html.php';
    exit();
  }
  $bookname = $file['bookname'];
  $bookautor = $file['bookautor'];
  $filename = $file['filename'];
  $mimetype = $file['mimetype'];
  $filedata = $file['filedata'];
  $disposition = 'inline';
  
  if ($_GET['action'] == 'download')
  {
    $mimetype = 'x-download';
    $disposition = 'attachment';
  }
  
  // Content-type must come before Content-disposition
  header("Content-type: $mimetype");
  header("Content-disposition: $disposition; filename=$filename");
  header('Content-length: ' . strlen($filedata));
  
  echo $filedata;
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'delete' and
    isset($_POST['id']))
{
  
  include $_SERVER['DOCUMENT_ROOT'] .'/biblioteca/includes/db.inc.php';
  
  $id = mysqli_real_escape_string($link, $_POST['id']);
  
  $sql = "DELETE FROM book
      WHERE id = '$id'";
  if (!mysqli_query($link, $sql))
  {
    $error = 'Database error deleting requested file.';
    include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/error.html.php';
    exit();
  }
  header('Location: .');
  exit();
}


include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/db.inc.php';

include 'files.html.php';

if( isset($_GET['action']) && $_GET['action'] == 'add_photo_to_item' ) {


	//include 'files.html.php';
	include 'cover_upload_form.html.php';
		
	exit();
}

	
if(isset($_GET['add_pictures'])) 
	{
		$item_id = $_POST['item_id'];
		//echo $item_id;
		//echo $_FILES['files']['name'][0];
		//echo $item_id;
		
		if(!empty($_FILES['files']['name'][0])){
			$files2 = $_FILES['files'];
			$uploaded = array();
			$failed   = array();
			
			$allowed  = array('jpg', 'png', 'jpeg');
			
			foreach($files2['name'] as $position => $file_name){
				$file_tmp   = $files2['tmp_name'][$position];
				$file_size  = $files2['size'][$position];
				$file_error = $files2['error'][$position];

				$file_ext = explode('.', $file_name);
				$file_ext = strtolower(end($file_ext));
				
				if(in_array($file_ext, $allowed)){
					if($file_error === 0){
						if($file_size <= 1000000){
							$file_name_new = uniqid('', true) . '.' . $file_ext;
							$file_destination = '/biblioteca/admin/books/cover_images/' . $file_name_new;
				
							
							$file_destination_transfer = $_SERVER['DOCUMENT_ROOT'] .$file_destination;
							
							include $_SERVER['DOCUMENT_ROOT'] .'/biblioteca/includes/db.inc.php';
							
							$sql = "UPDATE book SET cover_url = '$file_destination' WHERE id = '$item_id'";
							$result = mysqli_query($link, $sql);
							
							//echo "/".$file_destination."/";
							//echo "<br/>";
							if(move_uploaded_file($file_tmp, $file_destination_transfer)){
								$uploaded[$position] = $file_destination_transfer;
							}else{
								$failed[$position] = "[{$file_name}] failed to upload";
							}
						}else{
							$failed[$position] = "[{$file_name}] is too large";
						}
					}else{
						$failed[$position] = "[{$file_name}] failed to upload";
					}
				}else{
					$failed[$position] = "[{$file_name}] file extension '{$file_ext}' is not allowed";
				}
			}
			
			//if(!empty($uploaded)){
			//	print_r($uploaded);
			//}	
			
			//if(!empty($failed)){
			//	print_r($failed);
			//}
		}
	
   //header('Location: .');
	exit();
   }
     
//include 'files.html.php';
?>
