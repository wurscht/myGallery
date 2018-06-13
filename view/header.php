<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?=$GLOBALS['appurl']?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="<?=$GLOBALS['appurl']?>/css/style.css" rel="stylesheet">
		<script src="<?=$GLOBALS['appurl']?>/js/jscript.js"></script>
		<link rel="stylesheet" href="<?=$GLOBALS['appurl']?>/css/lightbox.css">
		<script src="<?=$GLOBALS['appurl']?>/js/lightbox.js"></script>
		<script src="<?=$GLOBALS['appurl']?>/js/jquery.min.js"></script>
    <title><?= $title ?></title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand text-light" href="<?php $GLOBALS['appurl']?>">My Gallery</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="navbar-nav mr-auto">
			<!-- fix schf -->
            <?php
            if (isset($_SESSION['userId']) == 0) {
              echo "<li class='nav-item'><a class='nav-link' href='$GLOBALS[appurl]/login'>Login</a></li>";
              echo "<li class='nav-item'><a class='nav-link' href='$GLOBALS[appurl]/login/registration'>Registration</a></li>";
							echo "<li class='nav-item'><a class='nav-link' href='$GLOBALS[appurl]/login/galleries'>Public galleries</a></li>";
            } else {
              echo "<li class='nav-item'><a class='nav-link' href='$GLOBALS[appurl]/gallery'>My Galleries</a></li>";
              echo "<li class='nav-item'><a class='nav-link' href='$GLOBALS[appurl]/gallery/create'>Create Gallery</a></li>";
              echo "<li class='nav-item'><a class='nav-link' href='$GLOBALS[appurl]/user/edit'>Edit Account</a></li>";
              echo "<li class='nav-item'><a class='nav-link' href='$GLOBALS[appurl]/login/logout'>Logout</a></li>";
            }
            ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container">
    <h3><?= $heading ?></h3>
