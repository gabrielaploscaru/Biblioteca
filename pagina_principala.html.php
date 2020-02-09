<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/biblioteca/includes/helpers.inc.php'; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/biblioteca/includes/navbar.html.php'; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/biblioteca/cautareform.html.php'; ?>

<div class="row">

 <?php foreach($array_results as $row) : ?>
	<div class="col-sm-3">
		<div class="card" style="width: 14rem;">
		  <img src="<?php echo $row['cover_url']?>" class="card-img-top" alt="...">
		 <div class="card-body">
			<h5 class="card-title"><?php echo $row['bookname'];?></h5>
			<p class="card-text"><?php echo $row['bookautor'];?></p>

		<form action="" method="get">
		  
			<input type="hidden" name="action" 
				value="download"/>
			<input type="hidden" name="id" 
				value="<?php echo $row['id']; ?>"/>
			<input class="btn btn-primary" type="submit" value="Download"/>
		 
		</form>
		   </div>
		</div>
	  </div>
<?php  endforeach; ?>

 </div>