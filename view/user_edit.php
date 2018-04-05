<form class="form-horizontal" action="doEdit" method="post">
	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <div class="component" data-html="true">
        <?php if ($_SESSION['userId'] == $user->uid): ?>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="title">Username</label>
		  <div class="col-md-4">
            <?php if ($_SESSION['userId'] == $user->uid): ?>
		  	   <input id="username" name="username" value="<?php echo $user->username ?>" required="required" type="text" class="form-control input-md">
            <?php endif ?> 
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="description">Email</label>
		  <div class="col-md-4">
            <?php if ($_SESSION['userId'] == $user->uid): ?>
		  	   <input id="email" name="email" value="<?php echo $user->email ?>" required="required" type="text" class="form-control input-md">
            <?php endif ?>
		  </div>
		</div>
        <div class="form-group">
		  <label class="col-md-2 control-label" for="due_date">Password</label>
		  <div class="col-md-4">
		  	<?php if ($_SESSION['userId'] == $user->uid): ?>
		  	   <input id="password" name="password" value="<?php echo $user->password ?>" required="required" type="password" class="form-control input-md">
            <?php endif ?>
		  </div>
		</div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="isAdmin">is admin</label>
		    <div class="col-md-4">
		  	   <input id="isAdmin" name="isAdmin" type="checkbox" class="input-xs" <?php if ($user->isAdmin == 1) { ?> checked="checked" <?php } ?>>
		    </div>
        </div>
        <?php endif ?>
        <div class=form-group">
          <?php if ($user->isAdmin == 1): ?>
            <?php foreach ($users as $galleryUser): ?>
              <div class="form-group">
		        <label class="col-md-2 control-label" for="title">Username</label>
		        <div class="col-md-4">
		          <?php echo $galleryUser->username ?>
		        </div>
		      </div>
              <div class="form-group">
		        <label class="col-md-2 control-label" for="description">Email</label>
		        <div class="col-md-4">
		          <input id="email" name="email" value="<?php echo $galleryUser->email ?>" required="required" type="text" class="form-control input-md">
		        </div>
		      </div>
              <div class="form-group">
		        <label class="col-md-2 control-label" for="due_date">Password</label>
		        <div class="col-md-4">
		  	      <input id="password" name="password" value="<?php echo $galleryUser->password ?>" required="required" type="password" class="form-control input-md">
		        </div>
		      </div>
              <div class="form-group">
                <label class="col-md-2 control-label" for="isAdmin">is admin</label>
		        <div class="col-md-4">
		  	      <input id="isAdmin" name="isAdmin" type="checkbox" class="input-xs" <?php if ($galleryUser->isAdmin == 1) { ?> checked="checked" <?php } ?>>
		        </div>
              </div>
            <?php endforeach ?>
          <?php endif ?>
        </div>
        
        
		<div class="form-group">
	      <label class="col-md-2 control-label" for="send">&nbsp;</label>
		  <div class="col-md-4">
		    <input id="send" name="send" type="submit" class="btn btn-primary" value="send" >
		  </div>
		</div>
	</div>
</form>