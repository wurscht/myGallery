<?php  
  $numOfCols = 4;
  $rowCount = 0;
  $bootstrapColWidth = 12 / $numOfCols;
?>
  <div class="container">
    <div class="row">
      <?php foreach ($pictures as $picture): ?>  
        <?php if ($gallery->gid == $picture->gid): ?>
          <div class="card mr-2 ml-2 mb-2 card-block" style="width: 15rem;">
            <a href="/myGallery/public/<?php echo $picture->path ?>" target="_blank">
              <img class="img-thumbnail" src='/myGallery/public/<?php echo $picture->thumb_path ?>' alt="Preview picture" onclick="openModal();currentSlide(<?php echo $counter ?>)">
            </a>
            <h4 class="text-center"><?php echo $picture->name ?></h3>
          </div>
          <?php 
            $rowCount++;
            if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
          ?>
        <?php endif ?>
      <?php endforeach ?>
    </div>
  </div>
