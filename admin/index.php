<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/biblioteca/includes/navbar.html.php'; ?>

	<head>
		<title>Biblioteca</title>
		<meta http-equiv="content-type"
			content="text/html; charset=utf-8"/>
			
		<style>
		body {
		  background-color: rgb(245, 244, 226);
		}
		
		h1 {
			color: rgb(102, 0, 51);
			margin-left: 200px;
		}
		
		/* unvisited link */
			a:link {
			  color: red;
			}

			/* visited link */
			a:visited {
			  color: green;
			}

			/* mouse over link */
			a:hover {
			  color: rgb(179, 0, 89);
			}

			/* selected link */
			a:active {
			  color: blue;
			} 
			
			ul li {
			background:rgb(255, 255, 245);
			margin: 5px;
			}	
			
			img {
			display: block;
			margin-left: auto;
			margin-right: auto;
			}
					
		</style>	
	 </head>
	
	
	<body>
	    <br>
		<br>
		<h1>Administrare Biblioteca</h1>
		<br>
		<ul>
			<li><a href="authors/">Administrare Utilizatori</a></li>
			<li><a href="books/">Administrare Carti</a></li>
			<li><a href="categories/">Administrare Categorii</a></li>
		</ul>
		
	<img src="download.jpg" alt="" height="400" width="800" class="center" >
	
	</body>
</html>