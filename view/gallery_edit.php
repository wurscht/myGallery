<form class="form-horizontal" action="doEdit" method="post">
	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <div class="component" data-html="true">
        <?php if ($_SESSION['userId'] == $user->uid): ?>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="title">Username</label>
		  <div class="col-md-4">
            <?php if ($_SESSION['userId'] == $user->uid): ?>
		  	   <input id="gallery_name" name="gallery_name" value="<?php echo $gallery->name ?>" required="required" type="text" class="form-control input-md">
            <?php endif ?> 
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="description">Email</label>
		  <div class="col-md-4">
            <?php if ($_SESSION['userId'] == $user->uid): ?>
		  	   <input id="gallery_description" name="gallery_description" value="<?php echo $gallery->description ?>" required="required" type="text" class="form-control input-md">
            <?php endif ?>
		  </div>
		</div>
        
        <?php endif ?>
        
		<div class="form-group">
	      <label class="col-md-2 control-label" for="send">&nbsp;</label>
		  <div class="col-md-4">
		    <input id="send" name="send" type="submit" class="btn btn-primary" value="edit" >
		  </div>
		</div>
	</div>
</form>