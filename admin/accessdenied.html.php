<?php include_once $_SERVER['DOCUMENT_ROOT'] .
	'/biblioteca/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Acces refuzat</title>
		<meta http-equiv="content-type"
			content="text/html; charset=utf-8"/>
	</head>
	
		
	<body>
	
	<style>
		body {
		  background-color: rgb(214, 209, 211);
		}
	</style>
		<h1>Acces refuzat</h1>
		<p><?php echo htmlout($error); ?></p>
	</body>
</html>