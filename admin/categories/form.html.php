<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/teste_ijdb/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title><?php htmlout($pagetitle); ?></title>
		<meta http-equiv="content-type"
			content="text/html; charset=utf-8"/>
			
			  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
			  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
			  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
		<h1><?php htmlout($pagetitle); ?></h1>
		
		<div class="card mb-3 mt-3 shadow-sm" >
        <div class="card-body">
			
		<form action="?<?php htmlout($action); ?>" method="post">
			
					<label for="name">Nume: <input type="text" name="name"
					id="name" value="<?php htmlout($name); ?>"/></label>
		
		     <div  class="float-right">

					<input type="hidden" name="id" value="<?php
					htmlout($id); ?>"/>
				<input type="submit" value="<?php htmlout($button); ?>"/>
			</div>
		</form>
		</div>
		</div>
	</body>
</html>