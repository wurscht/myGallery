<?php if (isset($_SESSION['userId']) && $_SESSION['userId']): ?>
<a href="<?php echo $GLOBALS['appurl'] . "/gallery/edit/" . $gallery->gid ?>">
  <i class="fas fa-edit"></i>
</a>
<?php $counter = 0; ?>
  <?php foreach ($pictures as $picture): ?>  
    <?php if (isset($gallery->gid) == isset($picture->gid)): ?>
      <div class="row">
        <div class="d-flex flex-column">
          <img class="img-thumbnail" src='/myGallery/public/<?php echo $picture->thumb_path ?>' alt="Preview picture" onclick="openModal();currentSlide(<?php echo $counter ?>)">
          <h4 class="text-center"><?php echo $picture->name ?></h3>
          <a name="edit-picture" class="btn btn-primary" href="<?php echo $GLOBALS['appurl'] . "/picture/edit/" . $picture->pid; ?>">Edit picture</a>
        </div>
      </div>
      <div id="myModal" class="modal">
        <span class="close cursor" onclick="closeModal()">&times;</span>
          <div class="modal-content">
            <div class="mySlides">
              <div class="numbertext"><?php echo $counter ?>/ <?php sizeOf($pictures) ?></div>
              <img src='/myGallery/public/<?php echo $picture->thumb_path ?>' style="width:100%">
            </div>
          </div>
      </div>
      <?php $counter++ ?>
    <?php endif ?>
  <?php endforeach ?>
<?php endif ?>