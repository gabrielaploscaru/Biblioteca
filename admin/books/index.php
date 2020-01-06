<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/biblioteca/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/biblioteca/includes/access.inc.php';

if (!userIsLoggedIn())
	{
		include '../login.html.php';
		exit();
	}

if (!userHasRole('Editor'))
	{
		$error='Doar utilizatorii cu drept de Editor pot accesa aceasta pagina.';
		include '../accessdenied.html.php';
		include '../logout.html.php';
		exit();
	}
	

if (isset($_GET['add']))
  {
		
	$pagetitle='Introducere Carte noua';
	$action='addform';
	$text='';
	$authorid='';
	$id='';
	$button='adauga carte';

	
	if (isset($_GET['add']))
	{	
	include $_SERVER['DOCUMENT_ROOT'].'/biblioteca/includes/db.inc.php';
		
	//Build the list of authors
	$sql="SELECT id, name FROM author";
	$result = mysqli_query($link, $sql);
	if (!$result)
		{
		$error='Eroare la afisarea listei de editori.';
		include 'error.html.php';
		exit();
		}

	while ($row=mysqli_fetch_array($result))
		{
		$authors[]=array('id'=>$row['id'], 'name'=>$row['name']);
		}

	//Build the list of categories
	$sql="SELECT id, name FROM category";
	$result=mysqli_query($link, $sql);
	if (!$result)
		{
		$error='Eroare la afisarea listei de cateorii.';
		include 'error.html.php';
		exit();
		}

	while ($row=mysqli_fetch_array($result))
		{
		$categories[]=array(
			'id'=>$row['id'],
			'name'=>$row['name'],
			'selected'=>FALSE);
		}

	include 'form.html.php';
	exit();
   }
   
  }


if (isset($_POST['action']) and $_POST['action'] == 'Edit')
  {
	include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/db.inc.php';
	
	$id = mysqli_real_escape_string($link, $_POST['id']);
	$sql = "SELECT id, bookname, bookautor, authorid FROM book WHERE id='$id'";
	$result = mysqli_query($link, $sql);
	if (!$result)
    {
		$error = 'Eroare la afisarea detaliilor despre carte.';
		include 'error.html.php';
		exit();
    }
	$row = mysqli_fetch_array($result);
	
	$pagetitle = 'Editare Carte';
	$action = 'editform';
	$text = $row['bookname'];
	$authorid = $row['authorid'];
	$id = $row['id'];
	$button = 'Actualizeaza carte';
	
	// Build the list of authors
	$sql = "SELECT id, name FROM author";
	$result = mysqli_query($link, $sql);
	if (!$result)
	{
		$error = 'Eroare la afisarea listei de editori.';
		include 'error.html.php';
		exit();
	}
	
	while ($row = mysqli_fetch_array($result))
	{
		$authors[] = array('id' => $row['id'], 'name' => $row['name']);
	}

	// Get list of categories containing this book
	$sql = "SELECT categoryid FROM bookcategory WHERE bookid='$id'";
	$result = mysqli_query($link, $sql);
	if (!$result)
	{
		$error = 'Eroare la afisarea listei de categorii selectate.';
		include 'error.html.php';
		exit();
	}
	
	while ($row = mysqli_fetch_array($result))
	{
		$selectedCategories[] = $row['categoryid'];
	}
	
	// Build the list of all categories
	$sql = "SELECT id, name FROM category";
	$result = mysqli_query($link, $sql);
	if (!$result)
	{
		$error = 'Eroare la afisarea listei de categorii.';
		include 'error.html.php';
		exit();
	}
	
	while ($row = mysqli_fetch_array($result))
    {
		$categories[] = array(
			'id' => $row['id'],
			'name' => $row['name'],
			'selected' => in_array($row['id'], $selectedCategories));
	}
	include 'form.html.php';
	exit();
  }
	
if (isset($_GET['addform']))
  {
	include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/db.inc.php';
	
	$text = mysqli_real_escape_string($link, $_POST['text']);
	$author = mysqli_real_escape_string($link, $_POST['author']);
	
	if ($author == '')
	{
		$error = 'Trebuie sa alegi un !!!!!! Editor--AUTOR pentru aceasta carte.
			Click &lsquo;back&rsquo; and try again.';
		include 'error.html.php';
		exit();
	}
	
	$sql = "INSERT INTO book SET
		bookname='$text',
		bookdate=CURDATE(),
		authorid='$author'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Eroare la adaugarea cartii.';
		include 'error.html.php';
		exit();
  }
	
	$bookid = mysqli_insert_id($link);
	
	if (isset($_POST['categories']))
	{
		foreach ($_POST['categories'] as $category)
		{
			$categoryid = mysqli_real_escape_string($link, $category);
			$sql = "INSERT INTO bookcategory SET
				bookid='$bookid',
				categoryid='$categoryid'";
			if (!mysqli_query($link, $sql))
			{
				$error = 'Error inserting book into selected category.';
				include 'error.html.php';
				exit();
			}
		}
	}
	
	header('Location: .');
	exit();
 }	
	
if (isset($_GET['editform']))
 {
	include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/db.inc.php';
	
	$text = mysqli_real_escape_string($link, $_POST['text']);
	$author = mysqli_real_escape_string($link, $_POST['author']);
	$id = mysqli_real_escape_string($link, $_POST['id']);
	
	if ($author == '')
	{
		$error = 'You must choose an author for this book.
			Click &lsquo;back&rsquo; and try again.';
		include 'error.html.php';
		exit();
	}
	
	$sql = "UPDATE book SET
		booktext='$text',
		authorid='$author'
		WHERE id='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error updating submitted book.';
		include 'error.html.php';
		exit();
	}
	
	$sql = "DELETE FROM bookcategory WHERE bookid='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error removing obsolete book category entries.';
		include 'error.html.php';
		exit();
    }
  }
  
if (isset($_POST['categories']))
	
  {
	  foreach ($_POST['categories'] as $category)
		{
		$categoryid = mysqli_real_escape_string($link, $category);
		$sql = "INSERT INTO bookcategory SET
			bookid='$id',
			categoryid='$categoryid'";
		if (!mysqli_query($link, $sql))
			{
			$error = 'Error inserting book into selected category.';
			include 'error.html.php';
			exit();
			}
		}
	
	  header('Location: .');
	  exit();
   }

   
if (isset($_POST['action']) and $_POST['action'] == 'Delete')
 {
		include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/db.inc.php';
		$id = mysqli_real_escape_string($link, $_POST['id']);
		
	// Delete category assignments for this book
	$sql = "DELETE FROM bookcategory WHERE bookid='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error removing book from categories.';
		include 'error.html.php';
		exit();
	}
	
	// Delete the book
	$sql = "DELETE FROM book WHERE id='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error deleting book.';
		include 'error.html.php';
		exit();
	}
	header('Location: .');
	exit();
 }


if (isset($_GET['action']) and $_GET['action'] == 'search')
 {
	include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/db.inc.php';
	// The basic SELECT statement
	$select = 'SELECT id, booktext';
	$from = ' FROM book';
	$where = ' WHERE TRUE';
	
	$authorid = mysqli_real_escape_string($link, $_GET['author']);
	if ($authorid != '') // An author is selected
	{
		$where .= " AND authorid='$authorid'";
	}

	$categoryid = mysqli_real_escape_string($link,$_GET['category']);
	if ($categoryid != '') // A category is selected
	{
		$from .= ' INNER JOIN bookcategory ON id = bookid';
		$where .= " AND categoryid='$categoryid'";
	}
	
	$text = mysqli_real_escape_string($link, $_GET['text']);
	if ($text != '') // Some search text was specified
	{
		$where .= " AND bookname LIKE '%$text%'";
	}
	
	$result = mysqli_query($link, $select . $from . $where);
	if (!$result)
	{
		$error = 'Eroare la afisarea catilor.';
		include 'error.html.php';
		exit();
	}
	while ($row = mysqli_fetch_array($result))
	{
		$books[] = array('id' => $row['id'], 'text' => $row['bookname']);
	}
	
	include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/db.inc.php';
	$result = mysqli_query($link, 'SELECT id, name FROM category');
	if (!$result)	
	{
		$error='Error fetching categories from database!';
		include 'error.html.php';
		exit();
	}	

	while ($row=mysqli_fetch_array($result))
	{
		$categories[]=array('id'=>$row['id'], 'name'=>$row['name']);
		
	}
	$result = mysqli_query($link, 'SELECT id, name FROM author');
	if (!$result)
	{
		$error = 'Eroare la afisarea editorilor  din bazab de date!';
		include 'error.html.php';
		exit();
	}	

	while ($row = mysqli_fetch_array($result))
	{
		$authors[] = array('id' => $row['id'], 'name' => $row['name']);
	}
	
	
	include  'searchform.html.php';
	include  'book.html.php';
	exit();
 }

// Display searchform
include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/db.inc.php';
$result = mysqli_query($link, 'SELECT id, name FROM category');
if (!$result)	
{
	$error='Eroare la afisarea cateoriilor din baza de date!';
	include 'error.html.php';
	exit();
}	

while ($row=mysqli_fetch_array($result))
{
	$categories[]=array('id'=>$row['id'], 'name'=>$row['name']);
}

$result = mysqli_query($link, 'SELECT id, name FROM author');
if (!$result)
{
	$error = 'Eroare la aisarea editorilor din baza de date!';
	include 'error.html.php';
	exit();
}	

while ($row = mysqli_fetch_array($result))
{
	$authors[] = array('id' => $row['id'], 'name' => $row['name']);
}

$result = mysqli_query($link, 'SELECT id, bookname, authorid FROM book');
if (!$result)
  {
	$error = 'Eroare la afisarea cartilor din baza de date!';
	include '../error.html.php';
	exit();
  }	

while ($row = mysqli_fetch_array($result))
  {
	$books[] = array('id' => $row['id'], 'text' => $row['bookname'], 'authorid' => $row['authorid']);
  }


include  'searchform.html.php';
include  'book.html.php';
  
?>