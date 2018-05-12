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
          <label class="col-md-1 control-label" for="isAdmin">is admin</label>
		  <input id="isAdmin" name="isAdmin" type="checkbox" class="input-xs" <?php if ($user->isAdmin == 1) { ?> checked="checked" <?php } ?>>
        </div>
        <?php endif ?>
      
        <div class="form-group d-flex justify-content-start">
		  <div class="col-md-1">
		    <input id="send" name="send" type="submit" class="btn btn-primary" value="send" >
		  </div>
          <div class="col-md-4">
            <a name="delete" class="btn btn-danger" href="<?php echo $GLOBALS['appurl'] . "/user/delete/" . $_SESSION['userId']; ?>" >Delete</a>
		  </div>
		</div>
      
        <?php if ($user->isAdmin == true): ?>
          <h3>Edit other users</h3>
          <?php foreach ($readAllExceptMyself as $nonadmins): ?>
            <p><?php echo $nonadmins->username; ?></p>
      
          <?php endforeach ?>
        <?php endif ?>
      
		
	</div>
</form>