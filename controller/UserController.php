<?php

require_once '../repository/UserRepository.php';

  class UserController {
    
    public function index() {
      
      $userRepository = new UserRepository();
      
      $view = new View('user_index');
      $view->title = 'Edit user informations';
      $view->heading = 'Edit user informations';
      $view->users = $userRepository->readAll();
      $view->display();
    }
  
    public function edit() {
      
      $userRepository = new UserRepository();
    
      $id = $_SESSION['userId'];
      if(!$id){
        echo "User has no id!";
      }
    
      $view = new View('user_edit');
      $view->title = 'Edit user informations';
      $view->heading = 'Edit user informations';
      $view->user = $userRepository->readById($id);
      $view->users = $userRepository->readAll();
      $view->display();
    }
  
    public function doEdit() {
    
      if(isset($_POST['send'])) {
        $id = $_SESSION['userId'];
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $userRepository = new UserRepository();
        if ($_POST['isAdmin'] == 'on') {
          $isAdmin = 1; 
        } else {
          $isAdmin = 0;
        }
        $pattern = preg_match('~(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$~', $password);
        
      
        if (!$pattern || strlen($password) <8) {
          $_SESSION['error'] = "Password has to contain at least 1 upper case letter, 1 number or special character and must be at least 8 characters in length!";
          header('Location:'. $GLOBALS['appurl'] . '/user/edit');
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $_SESSION['error'] = "Invalid email format!";
          header('Location:'. $GLOBALS['appurl'] . '/user/edit');
        } else if (!$userRepository->checkEmail($email)) {
          $_SESSION['error'] = "This Email is already used!";
          header('Location:'. $GLOBALS['appurl'] . '/user/edit');
        } else {
          $_SESSION['success'] = "Your changes were made";
          $userRepository->edit($id, $username, $email, $password, $isAdmin);
          header('Location:'. $GLOBALS['appurl'] . '/user/edit');
        }
      }
    }
  }
?>