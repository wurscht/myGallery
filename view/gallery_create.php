<form class="form-horizontal" action="doCreate" method="post" enctype="multipart/form-data">
    <div class="component" data-html="true">
        <?php if ($_SESSION['userId'] == $user->uid): ?>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="title">Gallery name</label>
		  <div class="col-md-4">
            <?php if ($_SESSION['userId'] == $user->uid): ?>
		  	   <input id="gallery_name" name="gallery_name" required="required" type="text" class="form-control input-md">
            <?php endif ?> 
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="description">Gallery description</label>
		  <div class="col-md-4">
            <?php if ($_SESSION['userId'] == $user->uid): ?>
		  	   <input id="gallery_description" name="gallery_description" required="required" type="text" class="form-control input-md">
            <?php endif ?>
		  </div>
		</div>
        <div class="form-group">
		  <label class="col-md-2 control-label" for="picture_name">Picture name</label>
		  <div class="col-md-4">
            <?php if ($_SESSION['userId'] == $user->uid): ?>
		  	   <input id="picture_name" name="picture_name" required="required" type="text" class="form-control input-md">
            <?php endif ?>
		  </div>
		</div>
        <div class="form-group">
		  <div class="col-md-4">
            <div class="custom-file" required>  
		      <input id="gallery_picture" name="gallery_picture" value="<?php echo $gallery->description ?>" required="required" type="file" class="custom-file-input" required>
              <label class="custom-file-label" for="gallery_picture">Choose picture...</label>
            </div>
		  </div>
		</div>
      
        <?php endif ?>
        
		<div class="form-group">
	      <label class="col-md-2 control-label" for="send">&nbsp;</label>
		  <div class="col-md-4">
		    <input id="send" name="send" type="submit" class="btn btn-primary" value="send" >
		  </div>
		</div>
	</div>
</form>