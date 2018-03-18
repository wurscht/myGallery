<?php
  /**
   * Registratons-Formular
   * Das Formular wird mithilfe des Formulargenerators erstellt.
   */
  $lblClass = "col-md-2";
  $eltClass = "col-md-4";
  $btnClass = "btn btn-success";
  $form = new Form($GLOBALS['appurl']."/login/doCreate");
  $button = new ButtonBuilder();
  echo $form->input()->label('Username')->name('username')->type('text')->lblClass($lblClass)->eltClass($eltClass);
  echo $form->input()->label('E-Mail')->name('email')->type('text')->lblClass($lblClass)->eltClass($eltClass);
  echo $form->input()->label('Password')->name('password')->type('password')->lblClass($lblClass)->eltClass($eltClass);
  echo $form->input()->label('Password (again)')->name('password-again')->type('password')->lblClass($lblClass)->eltClass($eltClass);
  echo $button->start($lblClass, $eltClass);
  echo $button->label('Register')->name('send')->type('submit')->class('btn-primary');
  echo $button->end();
  echo $form->end();
?>

 

