<?php include_once $_SERVER['DOCUMENT_ROOT']. '/biblioteca/includes/helpers.inc.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTM; 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Administrare carti</title>
		<meta http-equiv="content-type"
			cotent="text/html; charset=utf-8"/>
	</head>
	
	
	<style>
	table, th, td {
	  border: 1px solid black;
	}
	</style>

	
	<body>
	<h1>Rezultatul cautarii</h1>
	<?php if (isset($books)): ?>
	<table>
	  <tr><th>Titlul cartii</th><th>Optiuni</th></tr>
	  <?php foreach ($books as $book): ?>
	  <tr valign="top">
		<td><?php bbcodeout($book['text']); ?></td>
		<td>
		<form action="?" method="post"
		<div>
		  <input type="hidden" name='id' value="<?php htmlout($book['id']); ?>"/>
		  <input type="submit" name='action' value="Edit"/>
		  <input type="submit" name='action' value="Delete"/>
		</div>
		</form>
		</td>
	   </tr>
	<?php endforeach; ?>
   </table>
  <?php endif; ?>
  <p><a href="?">Cautare noua</a></p>
  <p><a href="..">Inapoi la Biblioteca </a></p>
  <?php include '../logout.html.php'; ?>
</body>
</html>	