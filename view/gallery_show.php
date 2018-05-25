<?php if (isset($_SESSION['userId']) && $_SESSION['userId']): ?>
<a href="<?php echo $GLOBALS['appurl'] . "/gallery/edit/" . $gallery->gid ?>">
  <i class="fas fa-edit"></i>
</a>
<?php $counter = 0; ?>
  <?php foreach ($pictures as $picture): ?>  
    <?php if ($gallery->gid == $picture->gid): ?>
      <div class="row">
        <div class="column">
          <img class="thumb hover-shadow" src='/myGallery/public/<?php echo $picture->thumb_path ?>' alt="Preview picture" onclick="openModal();currentSlide(<?php echo $counter ?>)">
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