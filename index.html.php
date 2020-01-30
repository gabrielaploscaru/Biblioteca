<?php include_once $_SERVER['DOCUMENT_ROOT'].'/biblioteca/includes/navbar.html.php'; ?>	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">	
			
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <title>Web Site By - carlaploscaru@gmail.com</title>
  <meta http-equiv="content-type"
    content="text/html; charset=utf-8"/>
</head>


<body>
	
<div class="container">

	<br/>
	<div class="row justify-content-center">
	   <h2>E-BIBLIOTECA</h2>
    </div>
	
	
 <h6>Cautare </h6>
    <div class="row">
        <div class="col-md-12">
            <form action="" accept-charset="UTF-8" method="get">
                <div class="input-group">
                    <input type="text" name="search" id="search" value="Cautare dupa titlu sau autor" placeholder="Search accounts, contracts and transactions" class="form-control">
                    <span class="input-group-btn">
                        <input type="button" name="commit" value="Search" class="btn btn-primary" data-disable-with="Search">
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
    </div> 
	
	<br/>
	<br/> -->

	<div class="row">
		<?php for($i = 0; $i< 8; $i ++) { ?>
			
			  <div class="col-sm-3">
				<div class="card" style="width: 12rem;">
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

 </body>
</html>


























