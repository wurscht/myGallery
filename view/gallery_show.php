<?php if (isset($_SESSION['userId']) && $_SESSION['userId']): ?>
<a href="<?php echo $GLOBALS['appurl'] . "/gallery/edit/" . $gallery->gid ?>">
  <i class="fas fa-edit"></i>
</a>
<?php  
  $numOfCols = 4;
  $rowCount = 0;
  $bootstrapColWidth = 12 / $numOfCols;
?>

  <div class="container">
    <div class="row">
  <?php foreach ($pictures as $picture): ?>  
    <?php if (isset($gallery->gid) == isset($picture->gid)): ?>
      
        <div class="col-sm d-flex flex-column">
          <a href="/myGallery/public/<?php echo $picture->path ?>" target="_blank">
            <img class="img-thumbnail" src='/myGallery/public/<?php echo $picture->thumb_path ?>' alt="Preview picture" onclick="openModal();currentSlide(<?php echo $counter ?>)">
          </a>
          <h4 class="text-center"><?php echo $picture->name ?></h3>
          <a name="edit-picture" class="btn btn-primary edit-picture" href="<?php echo $GLOBALS['appurl'] . "/picture/edit/" . $picture->pid; ?>">Edit picture</a>
        </div>
      
      <?php 
        $rowCount++;
        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
      ?>
    <?php endif ?>
  <?php endforeach ?>
    </div>
</div>
<?php endif ?>
