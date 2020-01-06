<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/biblioteca/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/biblioteca/includes/access.inc.php';

if (!userIsLoggedIn())
{
	include '../login.html.php';
	exit();
}

//echo $_POST['email'];


if (!userHasRole('Administrator'))
{
	$error='Doar utilizatorii cu drept de Administrator pot accesa aceasta pagina.';
	include '../accessdenied.html.php';
	include '../logout.html.php';
	exit();
}


if (isset($_GET['add']))
{
	include $_SERVER['DOCUMENT_ROOT'].'/biblioteca/includes/db.inc.php';
	$pagetitle='New Author';
	$action='addform';
	$name='';
	$pren='';
	$email='';
	$id='';
	$button='Add author';
	
	//Build the list of roles
	$sql = "SELECT id, description FROM role";
	$result=mysqli_query($link, $sql);
	if(!$result)
	{
		$error ='Eroarela incarcarea listei de roluri';
		include 'error.html.php';
		exit();
	}

	while ($row = mysqli_fetch_array($result))
	{
		$roles[] = array('id'=> $row['id'], 'description'=> $row['description'],
		           'selected' =>FALSE);
	}
	
	include 'form.html.php';
	exit();
}


if (isset($_GET['addform']))
{
		
	include $_SERVER['DOCUMENT_ROOT'].'/biblioteca/includes/db.inc.php';
	
	$name = mysqli_real_escape_string($link, $_POST['name']);
	$email = mysqli_real_escape_string($link, $_POST['email']);
	$pren = mysqli_real_escape_string($link, $_POST['pren']);
	$sql="INSERT INTO author SET 
		name='$name',
		pren='$pren',
		email='$email'";
		
	if (!mysqli_query($link, $sql))
		{
		$error='Eroare la adaugarea utilizatorului.';
		include '../error.html.php';
		exit();
		}
		
		$authorid=mysqli_insert_id($link);
		
	if ($_POST['password']!='')
		{
		$password=md5($_POST['password'].'biblioteca');
		$password=mysqli_real_escape_string($link, $password);
		$sql="UPDATE author SET
			password='$password'
			WHERE id='$authorid'";
			
	if (!mysqli_query($link, $sql))
		{
			$error='Eroare la introducerea parolei utilizatorului.';
			include '../error.html.php';
			exit();
		}	
}
	
	if (isset($_POST['roles']))
	{
		foreach ($_POST['roles'] as $role)
		{
			$roleid=mysqli_real_escape_string($link, $role);
			$slq="INSERT INTO authorrole SET
				authorid = '$authorid',
				roleid = '$roleid'";
			if (!mysqli_query($link,$sql))
			{
				$error='Eroare la stabilirea rolului pentru utilizator.';
				include 'error.html.php';
				exit();			
			}		
		}
	}
	header('Location:.');
	exit();
}


if (isset($_POST['action']) and $_POST['action']=='Edit')
{
	include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/db.inc.php';
	
	$id = mysqli_real_escape_string($link, $_POST['id']);
	$sql = "SELECT id, name, pren, email FROM author WHERE id='$id'";
	$result = mysqli_query($link, $sql);
	if (!$result)
		{
		$error = 'Eroare la afisarea detaliilor pentru utilizator.';
		include 'error.html.php';
		exit();
		}
		$row = mysqli_fetch_array($result);
		
		$pagetitle = 'Editare date Utilizator';
		$action = 'editform';
		$name = $row['name'];
		$pren = $row ['pren'];
		$email = $row['email'];
		$id = $row['id'];
		$button = 'Actualizare date utilizator';
		
		//Get list of roles assigned to this author
		$sql = "SELECT roleid FROM authorrole WHERE authorid='$id'";
		$result=mysqli_query($link, $sql);
		if (!$result)
		{
			$error='Eroare la afisarea listei de roluri.';
			include 'error.html.php';
			exit();
		}
		
		$selectedRoles=array();
		while ($row=mysqli_fetch_array($result))
		{
			$selectedRoles[]=$row['roleid'];
		}
		
		//Build the list of all roles
		$sql = "SELECT id, description FROM role";
		$result = mysqli_query($link, $sql);
		if (!$result)
		{
			$error='Eroare la afisarea listei de roluri.';
			include 'error.html.php';
			exit();
		}	
		
		while ($row=mysqli_fetch_array($result))

		{
			$roles[]=array(
				'id'=>$row['id'],
				'description'=>$row['description'],
				'selected'=>in_array($row['id'], $selectedRoles));
		}		
		include 'form.html.php';
		exit();
}

if (isset($_GET['editform']))
{
	include $_SERVER['DOCUMENT_ROOT'] .'/biblioteca/includes/db.inc.php';
	
	$id=mysqli_real_escape_string($link, $_POST['id']);
	$name=mysqli_real_escape_string($link, $_POST['name']);
	$pren=mysqli_real_escape_string($link, $_POST['pren']);
	$email=mysqli_real_escape_string($link, $_POST['email']);
	$sql="UPDATE author SET 
		name='$name',
		pren='$pren',
		email='$email'
		WHERE id='$id'";
	if (!mysqli_query($link, $sql))
		{
			$error='Eroare la actualizarea datelor de utilizator.';
			include 'error.html.php';
			exit();
		}

	if ($_POST['password']!='')
	{
		$password = md5($_POST['password'] . 'ijdb');
		$password=mysqli_real_escape_string($link, $password);
		$sql="UPDATE author SET
			password='$password'
			WHERE id='$id'";
		if (mysqli_query($link, $sql))
		{
			$error='Eroare la setarea parolei de utilizator.';
			include '../error.html.php';
			exit();
		}
	}
	
	$sql="DELETE FROM authorrole WHERE authorid='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error='Eroare la stergerea rolului utilizatorului.';
		include 'error.html.php';
		exit();
	}
	if (isset($_POST['roles']))
	{
		foreach($_POST['roles'] as $role )
		{
			$roleid = mysqli_real_escape_string($link, $role);
			$sql = "INSERT INTO authorrole SET
				authorid='$id',
				roleid='$roleid'";
			if (!mysqli_query($link, $sql))
			{
				$error = 'Eroare la alocarea catre utlizator a rolului selectat.';
				include '../error.html.php';
				exit();
			}
		}
	}
	header('Location: .');
	exit();
}
			
if (isset($_POST['action']) and $_POST['action'] == 'Delete')
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/db.inc.php';
		$id = mysqli_real_escape_string($link, $_POST['id']);
		
		// Delete role assignments for this author
		$sql = "DELETE FROM authorrole WHERE authorid='$id'";
		if (!mysqli_query($link, $sql))
		{
			$error = 'Eroare la stergerea rolurilor.';
			include '../error.html.php';
			exit();
		}
		
		// Get books belonging to author
		$sql = "SELECT id FROM book WHERE authorid='$id'";
		$result = mysqli_query($link, $sql);
		if (!$result)
		{
			$error = 'Eroare la aducerea listei de carti pentru a fi sterse';
			include 'error.html.php';
			exit();
		}
		
		//For each book
		while ($row=mysqli_fetch_array($result))	
		{
			$bookId = $row[0];
		
		// Delete book category entries
		$sql = "DELETE FROM bookcategory WHERE bookid='$bookId'";
		if (!mysqli_query($link, $sql))
		{
			$error = 'Eroare la stergerea intrarii categorie din book.';
			include 'error.html.php';
			exit();
		}
	}	
	
	// Delete book belonging to author
	$sql = "DELETE FROM book WHERE authorid='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Eroare stregerea cartii apartinand utilizatorului.';
		include 'error.html.php';
		exit();
	}
	
	// Delete the author
	$sql = "DELETE FROM author WHERE id='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Eroare la stererea utilizatorului.';
		include 'error.html.php';
		exit();
	}		
					
	header('Location: . ');
	exit();
}

// Display author list
include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/db.inc.php';
$result = mysqli_query($link, 'SELECT id, name FROM author');
if (!$result)
{
	$error = 'Error la aducerea utilizatorului din baza de date!';
	include 'error.html.php';
	exit();
}	

while ($row = mysqli_fetch_array($result))
{
	$authors[] = array('id' => $row['id'], 'name' => $row['name']);
}
include 'authors.html.php';
?>
