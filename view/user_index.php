<?php
  if (isset($_SESSION['userId']) && $_SESSION['userId']) {
?>
  
  <h1>User account information</h1>
    <?php $i = 0; ?>
    <?php foreach ($users as $user): ?>
      <?php if ($_SESSION['userId'] == $user->uid): ?>
        <div class="panel panel-default">
          <div class="panel-heading" data-toggle="collapse" data-target="#user_content-<?php echo $i; ?>"><?= $user->username; ?><i class="fa fa-angle-double-down" aria-hidden="true"></i></div>
          <div class="panel-body collapse" id="user_content-<?php echo $i; ?>">
            <p class="email">Email: <?= $user->email; ?></p>
            <p class="password">Password: <?= $user->password; ?></p>
            <a class="btn btn-primary btn_edit" title="Delete" href="/task/delete?id=<?= $task->id ?>">Delete</a>
            <a class="btn btn-primary btn_edit" title="Edit" href="/task/edit?id=<?= $task->id ?>">Edit</a>
          </div>
        </div>
      <?php endif ?> 
      <?php $i++; ?>
    <?php endforeach ?>
  
    
  
<?php
  } else {
?>
    <h1>You are not logged in!</h1>
<?php
  }
?>