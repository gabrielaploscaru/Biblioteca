<?php include_once $_SERVER['DOCUMENT_ROOT'] .
	'/biblioteca/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Log In</title>
		<meta http-equiv="content-type"
			content="text/html; charset=utf-8"/>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</head>
	
	<head>
		<style>
		body {
		  background-color: rgb(245, 244, 226);
		}
		</style>
	</head>
	
	<body>
	
	<div class="container">
	<h1>Log In</h1>
		<p>Introduceti datele cerute pentru a accesa pagina selectata.</p>
		<?php if (isset($loginError)): ?>
			<p><?php echo htmlout($loginError); ?></p>
		<?php endif; ?>
		<form action="" method="post">
			<div  class="form-group">
				<label for="email">Email:</label> 
				<input type="text"  class="form-control" name="email" id="email"/>
			</div>
			<div  class="form-group">
				<label for="password">Password: </label> 
				<input type="password"  class="form-control" name="password" id="password"/>
			</div>
			<div  class="form-group">
				<input type="hidden" name="action" value="login"/>
				<input type="submit" class="btn btn-default" value="Log in"/>
			</div>
		  </form>
		  
		   <p><a href="..">Inapoi la Biblioteca</a></p>
	</div>
	  
	  
	
	</body>
</html>