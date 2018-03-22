<?php
  /**
   * Login-Formular
   * Das Formular wird mithilfe des Formulargenerators erstellt.
   */
  // Login prüfen
/*
  if (isset($_SESSION['userData'])) {
    $email = $_SESSION['userData']['email'];
    $
  }
  */


  $lblClass = "col-md-2";
  $eltClass = "col-md-4";
  $btnClass = "btn btn-success";
  $form = new Form($GLOBALS['appurl']."/login/login");
  $button = new ButtonBuilder();
  echo $form->input()->label('E-Mail')->name('email')->type('text')->lblClass($lblClass)->eltClass($eltClass);
  echo $form->input()->label('Password')->name('password')->type('password')->lblClass($lblClass)->eltClass($eltClass);
  echo $button->start($lblClass, $eltClass);
  echo $button->label('Login')->name('send')->type('submit')->class('btn-primary');
  echo $button->end();
  echo $form->end();
?>
