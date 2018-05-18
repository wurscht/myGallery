<?php if (isset($_SESSION['userId']) && $_SESSION['userId']): ?>
<a href="<?php echo $GLOBALS['appurl'] . "/gallery/edit/" . $gallery->gid ?>">
  <i class="fas fa-edit"></i>
</a>
  <?php foreach ($pictures as $picture): ?>  
    <?php if ($gallery->gid == $picture->gid): ?>
      <img class="card-img-top" src='<?php echo $picture->path ?>' alt="Preview picture">
    <?php endif ?>
  <?php endforeach ?>
<?php endif ?>