<form class="form-horizontal" action="<?php echo $GLOBALS['appurl'] . "/gallery/doEdit" ?>" method="post">
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
            <?php if ($_SESSION['userId'] == $user->uid): ?>
		  	   <input id="gallery_description" name="gallery_description" value="<?php echo $gallery->description ?>" required="required" type="text" class="form-control input-md">
            <?php endif ?>
		  </div>
		</div>
        
        <?php endif ?>
        
		<div class="form-group d-flex justify-content-start">
		  <div class="col-md-1">
		    <input id="send" name="send" type="submit" class="btn btn-primary" value="edit" >
		  </div>
          <div class="col-md-4">
            <a name="delete" class="btn btn-danger" href="<?php echo $GLOBALS['appurl'] . "/gallery/delete/" . $gallery->gid; ?>" >Delete</a>
		  </div>
		</div>
	</div>
</form>