
  
<?php 

include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/db.inc.php';
	
		
if(isset($_GET['search'])) 
{
	$search_var = $_GET['search'];


	$sql_search = "SELECT * FROM book WHERE bookname LIKE '%$search_var%'";
	$search_res = mysqli_query($link, $sql_search);		



	if (!$search_res)
	{
		$error = 'Eroare la cautarea cartilor.';
		include 'includes/error.html.php';
		exit();
	}		
				
	$array_results = array();


	while ($row = mysqli_fetch_array($search_res))
	{
		$array_results[] = 
				array('id' => $row['id'], 
					  'bookname' => $row['bookname'],
					  'bookautor' => $row['bookautor'],
					  'cover_url' => $row['cover_url']
					 );
	}
	
	
	include 'pagina_principala.html.php';
	exit();	
}

		
		
	if (isset($_GET['action']) &&  $_GET['action'] == 'download' )
	 {
		  include 'includes/db.inc.php';
		  $id = mysqli_real_escape_string($link, $_GET['id']);
		  $sql = "SELECT bookname, filename, mimetype, filedata
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
		  $filename = $file['filename'];
		  $mimetype = $file['mimetype'];
		  $filedata = $file['filedata'];
		  $disposition = 'inline';
		  
		  if ($_GET['action'] == 'download')
		  {
			$mimetype = 'application/x-download';
			$disposition = 'attachment';
		  }
		  // Content-type must come before Content-disposition
		  header("Content-type: $mimetype");
		  header("Content-disposition: $disposition; filename=$filename");
		  header('Content-length: ' . strlen($filedata));
		  
		  
		  
		  echo $filedata;
		  exit();
	}
	
$sql_all_books = "SELECT * FROM book WHERE 1";
$res_all = mysqli_query($link, $sql_all_books);

$array_results = array();

while($row = mysqli_fetch_array($res_all)) {

	$array_results[] = 
		array('id' => $row['id'], 
			  'bookname' => $row['bookname'],
			  'bookautor' => $row['bookautor'],
			  'cover_url' => $row['cover_url']
			 );

}
	
include 'pagina_principala.html.php';

?>


	
