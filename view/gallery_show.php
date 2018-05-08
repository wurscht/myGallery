<?php if (isset($_SESSION['userId']) && $_SESSION['userId']): ?>
  <?php foreach ($pictures as $picture): ?>  
    <?php if ($gallery->gid == $picture->gid): ?>
      <img class="img-thumbnail thumb" width="200px" src='<?php echo $picture->path ?>' alt="Preview picture">
<i class="fas fa-edit"></i>
    <?php endif ?>
  <?php endforeach ?>
<?php endif ?>