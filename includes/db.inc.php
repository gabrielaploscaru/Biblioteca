<?php
$link = mysqli_connect('localhost', 'root', '');
if (!$link)
{
	$error = 'Eroare conexiune la baza de date.';
	include 'error.html.php';
	exit();
}

if (!mysqli_set_charset ($link, 'utf8'))
{
	$output='Eroare la codarea conexiunii bazei de date.';
	include 'output.html.php';
	exit();
}

if (!mysqli_select_db($link, 'biblioteca'))
{
	$error = 'Nu se poate localiza baza de date.';
	include 'error.html.php';
	exit();
}
?>