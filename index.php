


<?php include_once $_SERVER['DOCUMENT_ROOT'].'/biblioteca/includes/navbar.html.php'; ?>
		
		
	
		
<div class="container">

<br/>
	
 <h6>Cautare </h6>
    <div class="row">
        <div class="col-md-12">
            <form action="?search" accept-charset="UTF-8" method="get">
                <div class="input-group">
                    <input type="text" 
						   name="search" 
						   id="search" 
						   placeholder="Cautare dupa titlu sau autor"  
						   class="form-control">
                    <span class="input-group-btn">
                        <input type="submit"  class="btn btn-primary">
                     </span>
                </div>
            </form>
        </div>
    </div>

 <!--	<div class="input-group">
    <input type="text" class="form-control" placeholder="Search this blog">
    <div class="input-group-append">
      <button class="btn btn-secondary" type="button">
        <i class="icon-search"></i>
      </button>
    </div> -->
	
	<br/>
	<br/>

	
	
	<div class="row">
		<?php 
		
	include $_SERVER['DOCUMENT_ROOT'] . '/biblioteca/includes/db.inc.php';
	
		
	if(isset($_GET['search'])) {
		$search_var = $_GET['search'];
		
		
		$sql_search = "SELECT * FROM book WHERE bookname LIKE '%$search_var%'";
		$search_res = mysqli_query($link, $sql_search);		

		
		
		if (!$search_res)
		{
			$error = 'Eroare la cautarea cartilor.';
			include 'includes/error.html.php';
			exit();
		}		
					
		$array_results = array();
		
		
		
		while ($row = mysqli_fetch_array($search_res))
		{
			$array_results[] = 
					array('id' => $row['id'], 
						  'name' => $row['bookname'],
						  'author' => $row['bookautor'],
						  'cover_url' => $row['cover_url']
						 );
		}
	
					// creezi array care va contine fraza din search descompusa in cuvinte
					// ceva gen $array_key_words = explode($searchvar, " ");
				
					// foreach($array_key_words as ..) { }
				
	
				
				//$array_results = array();
				
				//$sql_search = 'SELECT * FROM AUTHOR ... LIKE ''';
				
				//$search_res = myslqi_query($link, $sql_search);
				
				//$num_rows = mysqli_num_rows($search_res);
				
				
				//while($row = ) {
					//$array
				//
				
				//if($num_rows == 0) 					
				//}
			
			  //print_r($array_results);
			  ?>
				
			
	<?php foreach($array_results as $row):?>			
			  
			 <div class="col-sm-3">
				<div class="card" style="width: 14rem;">
				  <img src="<?php echo $row['cover_url']?>" class="card-img-top" alt="...">
				  <div class="card-body">
					<h5 class="card-title"><?php echo $row['name'];?></h5>
					<p class="card-text"><?php echo $row['author'];?></p>
					<a href="#" class="btn btn-primary">Download</a>
				  </div>
				</div>
			  </div>
	
	
	<?php 
		  endforeach;
		exit();
	}
	?>
	
	<?php
		$sql_all_books = "SELECT * FROM book WHERE 1";
		$res_all = mysqli_query($link, $sql_all_books);
		
		while($row = mysqli_fetch_array($res_all)) {
	?>
			<div class="col-sm-3">
				<div class="card" style="width: 14rem;">
				  <img src="<?php echo $row['cover_url']?>" class="card-img-top" alt="...">
				  <div class="card-body">
					<h5 class="card-title"><?php echo $row['bookname'];?></h5>
					<p class="card-text"><?php echo $row['bookautor'];?></p>
					<a href="#" class="btn btn-primary">Download</a>
				  </div>
				</div>
			  </div>
	<?php
		}
	?>
	
	</div>
</div>

	
