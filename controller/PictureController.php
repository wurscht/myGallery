<?php

require_once '../repository/PictureRepository.php';
require_once '../repository/UserRepository.php';

class PictureController {
    
    public function delete($pid) {
        
        $pictureRepository = new PictureRepository();
        $pictureRepository->deleteById($pid);
        
        header('Location:'. $GLOBALS['appurl'] . '/gallery');
    }
    
    public function edit($pid) {
        
        $pictureRepository = new PictureRepository();
        $userRepository = new UserRepository();
        
        $userId = $_SESSION['userId'];
        
        $view = new View('picture_edit');
        $view->title = 'Edit picture';
        $view->heading = 'Edit picture';
        $view->user = $userRepository->readById($userId);
        $view->picture = $pictureRepository->readById($pid);
        $view->display();
    }
    
    public function doEdit() {
      

    $pictureRepository = new PictureRepository();
    
    if (isset($_POST['send'])) {
      $pid = htmlspecialchars($_POST['id']);
      $name = htmlspecialchars($_POST['picture_name']);

      $pictureRepository->edit($pid, $name);    

      header('Location:'. $GLOBALS['appurl'] . '/gallery');
      }
    }
}