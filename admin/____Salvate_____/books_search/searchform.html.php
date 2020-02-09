<?php include_once $_SERVER['DOCUMENT_ROOT'] .
'/biblioteca/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Administrare carti</title>
		<meta http-equiv="content-type"
			content="text/html; charset=utf-8"/>
	</head>
	
	
	<style>
		body {
		  background-color: rgb(245, 244, 226);
		}
	</style>


	
	<body>
	   
		<h1>-Administrare carti-</h1>
		<br>
		<br>
		<p><a href="?add"><h4>Adauga carte noua</h4></a></p>
		<br>
		<form action="" method="get">
			<p><h4>Cautare carti:</h4></p>
			
							
			<div>
				<label for="author">Dupa editor:</label>
				<select name="author" id="author">
				  <option value="">Orice editor</option>
				  <?php foreach ($authors as $author): ?>
				    <option value="<?php htmlout($author['id']); ?>"><?php htmlout($author['name']); ?></option>
				   <?php endforeach; ?>
				</select>
			</div>
			
			<div>
			   <label for="category">Dupa categorie:</label>
			   <select name="category" id="category">
			   <option value="">Orice categorie</option>
			   <?php foreach ($categories as $category): ?>
			       <option value="<?php htmlout($category['id']); ?>"><?php
                          htmlout($category['name']); ?></option>
               <?php endforeach; ?>
			   </select>
			</div>
			
			<div>
				<label for="text">Numele contine textul:</label>
				<input type="text" name="text" id="text"/>
			</div>
			<div>
				<input type="hidden" name="action" value="cauta"/>
				<input type="submit" value="Cauta"/>
			</div>
		</form>
			<p><a href="..">Inapoi la Biblioteca</a></p>
			<?php include '../logout.html.php'; ?>
			</body>
</html>