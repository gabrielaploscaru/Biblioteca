<?php include_once $_SERVER['DOCUMENT_ROOT'] .
'/biblioteca/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <title>Administrarea utilizatorilor</title>
  <meta http-equiv="content-type"
    content="text/html; charset=utf-8"/>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
</head>


<body>

       <style>
		body {
		  background-color: rgb(245, 244, 226);
		}
		</style>
		
	

   <div class="container">
	<h1>Administrare utilizatori</h1>
	
	<br>
	<br>
	<p><a href="?add">Adauga utilizator</a></p>
	<ul>
		<?php foreach ($authors as $author): ?>
		<li>
			<form action="" method="post">
			 <div>
				<?php htmlout($author['name']); ?>
				<input type="hidden" name="id" value="<?php
					echo $author['id']; ?>"/>
				<input type="submit" name="action" value="Edit"/>
				<input type="submit" name="action" value="Delete"/>
			</div>
		  </form>
		</li>
	<?php endforeach; ?>
	</ul>
	<br>
	<br>
   <p><a href="..">Inapoi la Bibioteca</a></p>
   <br>
   <?php include '../logout.html.php'; ?>
   
   </div>
 </body>
</html>