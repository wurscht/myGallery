<form class="form-horizontal" action="/task/doEdit" method="post">
	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <div class="component" data-html="true">
		<div class="form-group">
		  <label class="col-md-2 control-label" for="title">Title</label>
		  <div class="col-md-4">
		  	<input id="title" name="title" value="<?php echo $task->title ?>" required="required" type="text" placeholder="Title" class="form-control input-md">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="description">Description</label>
		  <div class="col-md-4">
              <textarea rows="4" cols="50" id="description" name="description" placeholder="Description" class="form-control input-md" required="required"><?php echo $task->description ?></textarea>
		  </div>
		</div>
        <div class="form-group">
		  <label class="col-md-2 control-label" for="due_date">Due-Date</label>
		  <div class="col-md-4">
		  	<input id="due_date" required="required" name="due_date" min="<?php echo date("$year-$month-$day") ; ?>" value="<?php echo $task->due_date ?>" type="date" class="form-control input-md">
		  </div>
		</div>
        <div class="form-group">
		  <label class="col-md-2 control-label" for="is_done">is done</label>
		  <div class="col-md-4">
		  	<input id="is_done" name="is_done" type="checkbox" class="input-xs" <?php if ($task->is_done == 1) { ?> checked="checked" <?php } ?>>
		  </div>
		</div>
		<div class="form-group">
	      <label class="col-md-2 control-label" for="send">&nbsp;</label>
		  <div class="col-md-4">
		    <input id="send" name="send" type="submit" class="btn btn-primary" value="send" >
		  </div>
		</div>
	</div>
</form>