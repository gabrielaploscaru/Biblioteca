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
	
	<body>
		<h1>Administrare carti</h1>
		<p><a href="?add"><h2>Adauga carte</h2></a></p>
		<form action="" method="get">
			<p>Afisare carti dupa urmatorul criteriu:</p>
			
			
			
			<div>
				<label for="book">Dupa autor:</label>
				<select name="book" id="book">
				  <option value="">Orice autor</option>
				  <?php foreach ($books as $book): ?>
				    <option value="<?php htmlout($book['id']); ?>"><?php htmlout($book['bookautor']); ?>
					</option>
				   <?php endforeach; ?>
				</select>
			</div>
			
			
			
			<div>
				<label for="author">Dupa editor:</label>
				<select name="author" id="author">
				  <option value="">Orice editor</option>
				  <?php foreach ($authors as $author): ?>
				    <option value="<?php htmlout($author['id']); ?>"><?php htmlout($author['name']); ?>
					</option>
				   <?php endforeach; ?>
				</select>
			</div>
			<div>
			   <label for="category">Dupa categorie:</label>
			   <select name="category" id="category">
			   <option value="">Orice category</option>
			   <?php foreach ($categories as $category): ?>
			       <option value="<?php htmlout($category['id']); ?>"><?php
                          htmlout($category['name']); ?></option>
               <?php endforeach; ?>
			   </select>
			</div>
			<div>
				<label for="text">Continand in titlu textul:</label>
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