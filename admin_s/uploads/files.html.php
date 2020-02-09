<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/biblioteca/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Uploading-Downloading Books</title>
    <meta http-equiv="content-type"
        content="text/html; charset=utf-8" />
  </head>
  <body>
    <h1>Uploading-Downloading Books</h1>
    <form action="" method="post" enctype="multipart/form-data">
      
	  <div>
        <label for="desc">Book Name:
        <input type="text" id="bname" name="bname"
            maxlength="255"/></label>
      </div>
	  
	  <div>
        <label for="desc">Book Author:
        <input type="text" id="bauth" name="bauth"
            maxlength="255"/></label>
      </div>
	  
	  	  
	  <div>
        <label for="upload">Upload Book:
        <input type="file" id="upload" name="upload"/></label>
      </div>
	  
      <div>
        <label for="desc">Book Description:
        <input type="text" id="desc" name="desc"
            maxlength="255"/></label>
      </div>
	  
     <div>
        <input type="hidden" name="action" value="upload"/>
        <input type="submit" value="Upload"/>
     </div> 
	 
	 <br/>
	  
	</form>
 
    <?php if (count($files) > 0): ?>
    <p><h4>The following books are stored in the database:</h4></p>
    <table>
      <thead>
        <tr>
          <th>Book name</th>	
          <th>File name</th>
          <th>Type</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($files as $f): ?>
		
        <tr valign="top">
		  <td><?php htmlout($f['bookname']); ?></td>
          <td>
            <a href="?action=view&amp;id=<?php htmlout($f['id']); ?>"
                ><?php htmlout($f['filename']); ?></a>
          </td>
          <td><?php htmlout($f['mimetype']); ?></td>
          <td><?php htmlout($f['description']); ?></td>
          
		   <td><img src="<?php htmlout($f['cover_url'])?>" height="150" width="150"></td>
		  <td>
            <form action="" method="get">
              <div>
                <input type="hidden" name="action" 
                    value="download"/>
                <input type="hidden" name="id" 
                    value="<?php htmlout($f['id']); ?>"/>
                <input type="submit" value="Download"/>
              </div>
            </form>
          </td>
          <td>
            <form action="" method="post">
              <div>
                <input type="hidden" name="action" value="delete"/>
                <input type="hidden" name="id" 
                    value="<?php htmlout($f['id']); ?>"/>
                <input type="submit" value="Delete"/>
              </div>
            </form>
          </td>
		  <td>
            <form action="" method="get">
              <div>
                <input type="hidden" name="action" value="add_photo_to_item"/>
                <input type="hidden" name="id" 
                    value="<?php htmlout($f['id']); ?>"/>
                <input type="submit" value="Upload picture"/>
              </div>
            </form>
          </td>
		 
        </tr>
  <?php endforeach; ?>
      </tbody>
    </table>
	
    <?php endif; ?>
  </body>
</html>
