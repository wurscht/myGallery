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
  

  public function show($galleryId) {
    
    $galleryRepository = new GalleryRepository();
    $pictureRepository = new PictureRepository();
    
    $gid = $galleryId;
    if(!$gid){
      echo "Gallery has no id!";
    }
    
    $view = new View('gallery_show');
    $view->title = "Gallery detail";
    $view->heading = "Gallery detail";
    $view->pictures = $pictureRepository->readAll();
    $view->gallery = $galleryRepository->readById($gid);
    
    $view->display();
  }
  
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
    
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gallery_picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    if ($_POST['send']) {
      $name = htmlspecialchars($_POST['gallery_name']);
      $description = htmlspecialchars($_POST['gallery_description']);
      $uid = $_SESSION['userId'];
      $picture_name = htmlspecialchars($_POST['picture_name']);
      $check = getimagesize($_FILES["gallery_picture"]["tmp_name"]);
  
      if($check !== false) {
        $_SESSION['success'] = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        $_SESSION['error'] = "File is not an image.";
        $uploadOk = 0;
      }
      
      $galleryRepository = new GalleryRepository();
      $pictureRepository = new PictureRepository();
      $galleryRepository->create($name, $description, $uid);
      $gid = $galleryRepository->getGalleryId();
      $pictureRepository->create($picture_name, $target_file, $gid);
      
        
      header('Location:'. $GLOBALS['appurl'] . '/gallery');
    }
    
  }
  
  public function delete($gid) {
    
    $galleryRepository = new GalleryRepository();
    $galleryRepository->deleteById($gid);
    // Anfrage an die URI /task weiterleiten (HTTP 302)
    header('Location:'. $GLOBALS['appurl'] .  '/gallery');
  }
  
  public function edit($gid) {
    
    $galleryRepository = new GalleryRepository();
    $userRepository = new UserRepository();
      
    if(!$gid){
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
    $view->gallery = $galleryRepository->readById($gid);
    $view->display();
  }
  
  public function doEdit() {
    
    if ($_POST['send']) {
      $galleryRepository = new GalleryRepository();
      $gid = htmlspecialchars($_POST['id']);
      $name = htmlspecialchars($_POST['gallery_name']);
      $description = htmlspecialchars($_POST['gallery_description']);
      $view->gallery = $galleryRepository->readById($gid);
      $galleryRepository->edit($gid, $name, $description);
      
      header('Location:'. $GLOBALS['appurl'] . '/gallery');
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