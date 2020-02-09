<?php include_once $_SERVER['DOCUMENT_ROOT']. '/biblioteca/includes/helpers.inc.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Manage Categories</title>
		<meta http-equiv="content-type"
			content="text/html; charset=utf-8"/>
			
			<!-- adauga in head pentru card-->
			  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
			  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
			  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
			<!-- pana aici -->
	</head>
	<body>
	
	<style>
		body {
		  background-color: rgb(245, 244, 226);
		}
	</style>
	
	<!-- adauga pentu centrare pagina imediat dupa body , inchide div ul inainte sa inchizi body -->
	<div class="container">
	
		<h1>Manage Categories</h1>
		<p><a href="?add"> Add new category</a></p>
		
		   <?php foreach ($categories as $category):?>
		   
		   <!-- adaug astea 2 linii - inlocuieste <ul><li> -->
		   <div class="card mb-3 mt-3 shadow-sm" >
            <div class="card-body">
		   <!-- pana aici -->
		   
		      <form action="" method="post">
			   
			    <?php htmlout($category['name']);?>
			  
			    <div  class="float-right">
					
					<input type="hidden" name="id" value="<?php echo $category['id']; ?>"/>
					<input type="submit" name="action" value="Edit"/>
					<input type="submit" name="action" value="Delete"/>
				</div>
			  </form>
			
			</div>
		  </div>
		<?php endforeach; ?>
		</body>
	
		<p><a href="..">Return to Biblioteca</a></p>
		<?php include '../logout.html.php'; ?>
		
		</div>
	</body>
	
</html>