
<?php
if (isset($_SESSION['userId']) && $_SESSION['userId']) {
?>
<!-- <a href="index.php?function=" -->
  <article class="hreview open special col-xs-6 d-flex flex-wrap justify-content-center">
    <?php if (empty($galleries)): ?>
      <div class="dhd">
        <h2 class="item title">No Gallery found. Create one!</h2>
      </div>
    <?php else: ?>
      <?php foreach ($galleries as $gallery): ?>
        <?php if ($gallery->uid == $_SESSION['userId']): ?>
          <div class="card mr-2 ml-2 mb-2" style="width: 18rem;">
            <?php foreach ($pictures as $picture): ?>
              <?php if ($gallery->gid == $picture->gid): ?>
                <img class="card-img-top" src='<?php echo $picture->path ?>' alt="Preview picture">
              <?php endif ?>
            <?php endforeach ?>
            <div class="card-body">
              <h5 class="card-title"><?php echo $gallery->name ?></h5>
              <p class="card-text"><?php echo $gallery->description ?></p>
            </div>
          </div>  
        <?php endif ?>
      <?php endforeach ?>
    <?php endif ?>
  </article>
<?php
} else {
?>
<div class="alert alert-danger">You are not logged in!</div>
<?php
}
?>