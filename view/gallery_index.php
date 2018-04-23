
<?php
if (isset($_SESSION['userId']) && $_SESSION['userId']) 
    {
?>
  <article class="hreview open special col-xs-6 d-flex">
    <?php if (empty($galleries)): ?>
      <div class="dhd">
        <h2 class="item title">No Gallery found. Create one!</h2>
      </div>
    <?php else: ?>
      <?php foreach ($galleries as $gallery): ?>
        <?php if ($gallery->uid == $_SESSION['userId']): ?>
          <div class="card mr-2 ml-2" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Teeeest<?php $gallery->name ?></h5>
              <p class="card-text">tesst wuwuwuwu<?php $gallery->description ?></p>
            </div>
          </div>
        <?php endif ?>
      <?php endforeach ?>
    <?php endif ?>
  </article>
<?php
} else {
?>
<h1 class="h_subpage">You are not logged in!</h1>
<?php
    }
?>