<?php include_once $_SERVER['DOCUMENT_ROOT'] .
	'/biblioteca/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title><?php htmlout($pagetitle); ?></title>
		<meta http-equiv="content-type"
			content="text/html; charset=utf-8"/>
			   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</head>
	
 echo $roleid;	 
	
 <body>
 
   <style>
		body {
		  background-color: rgb(245, 244, 226);
		}
   </style>
   
  <div class="container">
	<br>
	<h2><?php htmlout($pagetitle); ?></h2>
	<form action="?<?php htmlout($action); ?>" method="post">
		<br>
		<div>
			<label for="name">Nume: <input type="text" name="name"
				id="name" value="<?php htmlout($name); ?>"/></label>
		</div>
		<div>
			<label for="pren">Prenume: <input type="text" name="pren"
				id="pren" value="<?php htmlout($pren); ?>"/></label>
		</div>
		<div>
			<label for="email">Email: <input type="text" name="email"
				id="email" value="<?php htmlout($email); ?>"/></label>
		</div>
		<div>
			<label for="password">Parola: <input type="password"
				name="password" id="password"/></label>
		</div>
		<br>
		<br>
		<fieldset>
		
		<legend>Roluri:</legend>
		<?php for ($i = 0; $i < count($roles); $i++): ?>
			<div>
				<label for="role<?php echo $i; ?>"><input
				type="checkbox" name="roles[]"
				id="role<?php echo $i; ?>"
				value="<?php htmlout($roles[$i]['id']); ?>"<?php
				if ($roles[$i]['selected'])
				{
					echo ' checked="checked"';
				}
				?>/><?php htmlout($roles[$i]['id']); ?></label>:
				<?php htmlout($roles[$i]['description']); ?>
			</div>
		<?php endfor; ?>
		</fieldset>
			<br>
			<div>
			<input type="hidden" name="id" value="<?php
				htmlout($id); ?>"/>
			<input type="submit" value="<?php htmlout($button); ?>"/>
			</div>
			
		</form>
	</div>
 </body>
</html>