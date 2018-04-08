<?php

class GalleryController {
  
  public function index() {
      
    $galleryRepository = new GalleryRepository();
    
    $view = new View('gallery_index');
    $view->title = 'My Galleries';
    $view->heading = 'My Galleries';
    $view->galleries = $galleryRepository->readAll();
    $view->display();
  }
  
  public function create() {
    
    $view = new View('gallery_create');
    $view->title = 'Create gallery';
    $view->heading = 'Create gallery';
    $view->display();
  }
  
  public function doCreate() {
    
    if ($_POST['send']) {
      $name = htmlspecialchars($_POST['name']);
      $description = htmlspecialchars($_POST['description']);
      
      if ($this->nameError()) {
        
      } else if ($this->descriptionError()) {
        
      } else {
        $galleryRepository = new GalleryRepository();
        $galleryRepository->create($name, $description);
        
        header('Location: /gallery');
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
        
    $id = $_GET['id'];
    if(!$id){
        echo "Gallery has no id!";
    }
        
    $view = new View('gallery_edit');
    $view->title = 'Edit gallery';
    $view->heading = 'Edit gallery';
    $view->task = $galleryRepository->readById($id);
    $view->display();
  }
  
  public function doEdit() {
    
    if ($_POST['send']) {
      $id = htmlspecialchars($_POST['id']);
      $name = htmlspecialchars($_POST['name']);
      $description = htmlspecialchars($_POST['description']);
      if ($this->titleError()) {
          
      } else if ($this->descriptionError()) {
            
      } else {
        $galleryRepository = new GalleryRepository();
        $galleryRepository->edit($id, $name, $description);
        header("Location: /gallery");
        exit;
      }
    }
  }
  
  public function nameError() {
    
    if (strlen($_POST['title']) > 60 || strlen($_POST['title']) < 3) {
      $view = new view('gallery_name_error');
      $view->title = 'Name error';
      $view->heading = 'Name error';
      $view->display();
      return true;
    }
  }
  
  public function descriptionError() {
    
    if (strlen($_POST['description']) > 300 || strlen($_POST['description']) < 3) {
      $view = new view('gallery_description_error');
      $view->title = 'Description error';
      $view->heading = 'Description error';
      $view->display();
      return true;
    }
  }
  
}
?>