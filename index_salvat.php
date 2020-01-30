


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
				
				// creezi array care va contine fraza din search descompusa in cuvinte
				// ceva gen $array_key_words = explode($searchvar, " ");
				
				// foreach($array_key_words as ..) { }
				
				
				
				$array_results = array();
				
				$sql_search = 'SELECT * FROM AUTHOR ... LIKE ''';
				
				$search_res = myslqi_query($link, $sql_search);
				
				$num_rows = mysqli_num_rows($search_res);
				
				
				while($row = ) {
					$array
				}
				
				if($num_rows == 0) {
					
				}
				
				echo  $_GET['search'];
			}
		?>
	
		<?php for($i = 0; $i< 8; $i ++) { ?>
			
			  <div class="col-sm-3">
				<div class="card" style="width: 14rem;">
				  <img src="book.jpg" class="card-img-top" alt="...">
				  <div class="card-body">
					<h5 class="card-title">Titlul cartii</h5>
					<p class="card-text">Some text</p>
					<a href="#" class="btn btn-primary">Detalii...</a>
				  </div>
				</div>
			  </div>
			
			
		<?php } ?>
	</div>
</div>

	
