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
    
    $galleryRepository = new GalleryRepository();
    $pictureRepository = new PictureRepository();
    $target_dir = "uploads/";
    $target_dir_thumbs = "uploads/thumbs/";
    $target_file = $target_dir . basename($_FILES["gallery_picture"]["name"]);
    $src_file = @imagecreatefromjpeg($_FILES["gallery_picture"]["tmp-name"]);
    $thumbnail_file = $target_dir_thumbs . basename($_FILES["gallery_picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      
    $new_w = 120;
    $new_h = 120;
    
    $orig_w = imagesx($src_file);
    $orig_h = imagesx($src_file);
      
    $w_ratio = ($new_w / $orig_w);
    $h_ratio = ($new_h / $orig_h);
      
    if ($orig_w > $orig_h) {
        $crop_w = round($orig_w * $h_ratio);
        $crop_h = $new_h;
        $src_x = ceil(($orig_w - $orig_h) / 2);
        $src_y = 0;
    } elseif ($orig_w < $orig_h) {
        $crop_h = round($orig_h * $w_ratio);
        $crop_w = $new_w;
        $src_x = 0;
        $src_y = ceil(($orig_h - $orig_w) / 2);
    } else {
        $crop_w = $new_w;
        $crop_h = $new_h;
        $src_x = 0;
        $src_y = 0;
    }
      
    $dest_img = imagecreatetruecolor($new_w, $new_h);
    imagecopyresampled($dest_img, $src_file, 0, 0, $src_x, $src_y, $crop_w, $crop_h, $orig_w, $orig_h);
      
    imagejpeg($dest_img, $thumbnail_file);
    
    if (isset($_POST['send'])) {
      $name = htmlspecialchars($_POST['gallery_name']);
      $description = htmlspecialchars($_POST['gallery_description']);
      $uid = $_SESSION['userId'];
      $picture_name = htmlspecialchars($_POST['picture_name']);
      $check = getimagesize($_FILES["gallery_picture"]["tmp_name"]);
  
      if($check !== false) {
        $uploadOk = 1;
      } else {
        $_SESSION['error'] = "File is not an image.";
        $uploadOk = 0;
      }
        
      if ($_FILES['gallery_picture']["size"] > 4000000) {
          $_SESSION['error'] = "Sorry, your file is too large.";
          $uploadOk = 0;
      }
    
      if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
          $_SESSION['error'] = "Sorry, only JPG, JPEG & PNG files are allowed.";
          $uploadOk = 0;
      }
        
      if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
      } else {
          if (move_uploaded_file($_FILES["gallery_picture"]["tmp_name"], $target_file)) {          
              $galleryRepository->create($name, $description, $uid);
              $gid = $galleryRepository->getGalleryId();
              $pictureRepository->create($picture_name, $target_file, $thumbnail_file, $gid);
              $_SESSION['success'] = "Gallery has been created and Image has been uploaded";
              
          } else {
              $_SESSION['error'] = "Sorry, there was an error uploading your file.";
          }
      }
        
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
      
    $galleryRepository = new GalleryRepository();
    $pictureRepository = new PictureRepository();
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gallery_picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    if (isset($_POST['send'])) {
      $gid = htmlspecialchars($_POST['id']);
      $name = htmlspecialchars($_POST['gallery_name']);
      $description = htmlspecialchars($_POST['gallery_description']);
      $view->gallery = $galleryRepository->readById($gid);
      $galleryRepository->edit($gid, $name, $description);
      $uid = $_SESSION['userId'];
      $picture_name = htmlspecialchars($_POST['picture_name']);
      $check = getimagesize($_FILES["gallery_picture"]["tmp_name"]);
      
      if($check !== false) {
        $uploadOk = 1;
      } else {
        $_SESSION['error'] = "File is not an image.";
        $uploadOk = 0;
      }
        
      if ($_FILES['gallery_picture']["size"] > 4000000) {
          $_SESSION['error'] = "Sorry, your file is too large.";
          $uploadOk = 0;
      }
    
      if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
          $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
      }
        
      if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
      } else {
          if (move_uploaded_file($_FILES["gallery_picture"]["tmp_name"], $target_file)) {
              $galleryRepository->edit($gid, $name, $description);
              $pictureRepository->create($picture_name, $target_file, $gid);
              $_SESSION['success'] = "Gallery has been created and Image has been uploaded";
          } else {
              $_SESSION['error'] = "Sorry, there was an error uploading your file.";
          }
      }
        
      header('Location:'. $GLOBALS['appurl'] . '/gallery');
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