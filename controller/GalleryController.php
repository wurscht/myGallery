<?php

require_once '../repository/GalleryRepository.php';
require_once '../repository/PictureRepository.php';
require_once '../repository/UserRepository.php';


class GalleryController {
  
  public function index() {
      
    $galleryRepository = new GalleryRepository();
    $pictureRepository = new PictureRepository();
    
    $view = new View('gallery_index');
    $view->title = 'My Galleries';
    $view->heading = 'My Galleries';
    $view->galleries = $galleryRepository->readAll();
    $view->pictures = $pictureRepository->readAll();
    
    $view->display();
  }
  
<<<<<<< HEAD
  public function show($galleryId) {
    
    $galleryRepository = new GalleryRepository();
=======
  /*public function show() {
    
    $galleryRepository = new GalleryRepository();
    
>>>>>>> 8ad8515f4adab48c4618cc8a86ce7df9c4ca5072
    
    $gid = $galleryId;
    if(!$gid){
      echo "Gallery has no id!";
    }
      
    $galleryId = $galleryRepository->getGalleryId($id);
    
    
    $view = new View('gallery_show');
<<<<<<< HEAD
    $view->title = "Gallery detail";
    $view->heading = "Gallery detail";
    $view->gallery = $galleryRepository->readById($gid);
    
    $view->display();
  }
=======
    $view->title = $gallery['name'];
    $view->heading = $gallery['name'];
    $view->gallery = $galleryRepository->readById($id);
  } */
>>>>>>> 8ad8515f4adab48c4618cc8a86ce7df9c4ca5072
  
  public function create() {
    
    $userRepository = new UserRepository();
    
    $id = $_SESSION['userId'];
    if(!$id){
      echo "User has no id!";
    }
    
    $view = new View('gallery_create');
    $view->title = 'Create gallery';
    $view->heading = 'Create gallery';
    $view->user = $userRepository->readById($id);
    $view->display();
  }
  
  public function doCreate() {
    
    if ($_POST['send']) {
      $name = htmlspecialchars($_POST['gallery_name']);
      $description = htmlspecialchars($_POST['gallery_description']);
      $uid = $_SESSION['userId'];
      
      if ($this->nameError()) {
        
      } else if ($this->descriptionError()) {
        
      } else {
        $galleryRepository = new GalleryRepository();
        $galleryRepository->create($name, $description, $uid);
        
        header('Location:'. $GLOBALS['appurl'] . '/gallery');
      }
    }
  }
  
  public function delete() {
    
    $galleryRepository = new GalleryRepository();
    $galleryRepository->deleteById($_GET['id']);
    // Anfrage an die URI /task weiterleiten (HTTP 302)
    header('Location: /gallery');
  }
  
  public function edit() {
    
    $galleryRepository = new GalleryRepository();
    $userRepository = new UserRepository();
      
    $galleryId = $galleryRepository->getGalleryId("Test gallery", 15);
      
    $_SESSION['galleryId'] = $galleryId;
        
    $galleryId = $_SESSION['galleryId'];
    if(!$galleryId){
        echo "Gallery has no id!";
    }
      
    $userId = $_SESSION['userId'];
    if(!$userId){
      echo "User has no id!";
    }
        
    $view = new View('gallery_edit');
    $view->title = 'Edit gallery';
    $view->heading = 'Edit gallery';
    $view->user = $userRepository->readById($userId);
    $view->gallery = $galleryRepository->readById($galleryId);
    $view->display();
  }
  
  public function doEdit() {
    
    if ($_POST['send']) {
      $id = htmlspecialchars($_POST['id']);
      $name = htmlspecialchars($_POST['gallery_name']);
      $description = htmlspecialchars($_POST['gallery_description']);
      $galleryRepository = new GalleryRepository();
      $galleryRepository->edit($id, $name, $description);
      header("Location: /gallery");
      exit;
    }
  }
  
  public function nameError() {
    
    if (strlen($_POST['gallery_name']) > 60 || strlen($_POST['gallery_name']) < 3) {
      $view = new view('gallery_name_error');
      $view->title = 'Name error';
      $view->heading = 'Name error';
      $view->display();
      return true;
    }
  }
  
  public function descriptionError() {
    
    if (strlen($_POST['gallery_description']) > 300 || strlen($_POST['gallery_description']) < 3) {
      $view = new view('gallery_description_error');
      $view->title = 'Description error';
      $view->heading = 'Description error';
      $view->display();
      return true;
    }
  }
  
}
?>