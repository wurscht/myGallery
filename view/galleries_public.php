
  <article class="hreview open special col-xs-6 d-flex flex-wrap justify-content-center">
    <?php if (empty($galleries)): ?>
      <div class="dhd">
        <h2 class="item title">No Gallery found. Create one!</h2>
      </div>
    <?php else: ?>
      <?php foreach ($galleries as $gallery): ?>
        <?php $count = 0; ?>
        <?php if ($gallery->public == 1): ?>
          <a class="link" href="<?php echo $GLOBALS['appurl'] . "/login/show/" . $gallery->gid; ?>">
            <div class="card mr-2 ml-2 mb-2 card-block" style="width: 18rem;">
              <?php foreach ($pictures as $picture): ?>
                <?php if ($gallery->gid == $picture->gid and $count < 1): ?>
                  <img class="card-img-top preview_picture" src='/myGallery/public/<?php echo $picture->thumb_path ?>' alt="Preview picture">
                  <?php $count++; ?>
                <?php endif ?>
              <?php endforeach ?>
              <div class="card-body">
                <h5 class="card-title"><?php echo $gallery->name ?></h5>
                <p class="card-text"><?php echo $gallery->description ?></p>
              </div>
            </div>  
          </a>
        <?php endif ?>
      <?php endforeach ?>
    <?php endif ?>
  </article>
