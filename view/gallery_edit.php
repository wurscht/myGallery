<form class="form-horizontal" action="<?php echo $GLOBALS['appurl'] . "/gallery/doEdit" ?>" enctype="multipart/form-data" method="post">
	<input type="hidden" name="id" value="<?php echo $gallery->gid; ?>">
    <div class="component" data-html="true">
    <?php if ($_SESSION['userId'] == $user->uid): ?>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="title">Name</label>
		  <div class="col-md-4">
      	<?php if ($_SESSION['userId'] == $user->uid): ?>
		  		<input id="gallery_name" name="gallery_name" value="<?php echo $gallery->name; ?>" required="required" type="text" class="form-control input-md">
        <?php endif ?> 
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="description">Description</label>
		  <div class="col-md-4">
		    <input id="gallery_description" name="gallery_description" value="<?php echo $gallery->description ?>" required="required" type="text" class="form-control input-md">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-1 control-label" for="public">Public</label>
		  <input id="gallery_public" name="gallery_public" type="checkbox" class="input-xs" <?php if ($gallery->public == 1) { ?> checked="checked" <?php } ?>>
		</div>
		<div class="mb-3">
			<input id="send" name="send" type="submit" class="btn btn-primary" value="send" >
		</div>
		<?php endif ?>
	</div>
</form>

<form class="form-horizontal" action="<?php echo $GLOBALS['appurl'] . "/gallery/doUpload" ?>" enctype="multipart/form-data" method="post">
	<input type="hidden" name="gid" value="<?php echo $gallery->gid; ?>">
	<h3>Upload picture</h3>
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
	<div class="form-group d-flex justify-content-start">
		<div class="mr-3">
			<input id="upload" name="upload" type="submit" class="btn btn-primary" value="upload" >
		</div>
    <div class="mr-3">
    	<a name="delete" class="btn btn-danger" href="<?php echo $GLOBALS['appurl'] . "/gallery/delete/" . $gallery->gid; ?>" >Delete</a>
		</div>
    <div>
    	<a name="back" class="btn btn-primary" href="<?php echo $GLOBALS['appurl'] . "/gallery/show/" . $gallery->gid; ?>">Back</a>
		</div>
	</div>
</form>