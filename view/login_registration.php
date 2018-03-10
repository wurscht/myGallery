<?php
  /**
   * Registratons-Formular
   * Das Formular wird mithilfe des Formulargenerators erstellt.
   */
?>
<form class="form-horizontal" action="registration/doCreate" method="post">
	<div class="component" data-html="true">
		<div class="form-group">
		  <label class="col-md-2 control-label" for="username">Username</label>
		  <div class="col-md-4">
		  	<input id="username" name="username" type="text" placeholder="Username" class="form-control input-md">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="email">Email</label>
		  <div class="col-md-4">
		  	<input id="email" name="email" type="text" placeholder="Email" class="form-control input-md">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="password">Password</label>
		  <div class="col-md-4">
		  	<input id="password" name="password" type="password" placeholder="Password" class="form-control input-md">
		  </div>
		</div>
		<div class="form-group">
	      <label class="col-md-2 control-label" for="send">&nbsp;</label>
		  <div class="col-md-4">
		    <input id="send" name="send" type="submit" class="btn btn-primary" value="Register">
		  </div>
		</div>
	</div>
</form>
 

