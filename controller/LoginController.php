<?php
require_once '../repository/UserRepository.php';
require_once '../repository/GalleryRepository.php';
require_once '../repository/PictureRepository.php';
/**
 * Controller for login and registration.
 *
 */
  class LoginController
  {
    /**
     * Shows login form
	 * Dispatcher: /login
     *
     */
    public function index()
    {
      $view = new View('login_index');
      $view->title = 'MyGallery';
      $view->heading = 'Login';
      $view->display();
    }
    
    /**
     * Shows registration form
	 * Dispatcher: /login/registration
     *
     */
    public function registration()
    {
      $view = new View('login_registration');
      $view->title = 'MyGallery';
      $view->heading = 'Registration';
      $view->display();
    }
    
    /**
     * Functions for login
     * Logs a User to his member area
     *
     */
    public function login() {
        
      if ($_POST['send'] && isset($_POST['email']) && isset($_POST['password'])) {
        $userRepository = new UserRepository();
        $hash = $userRepository->getPasswordHash($_POST['email']);
        $password = password_verify($_POST['password'], $hash);
        $userId = $userRepository->getUserId($_POST['email'], $hash);
        
        if ($userId > 0 && $password) {
          $_SESSION['userId'] = $userId;
          header('Location:'. $GLOBALS['appurl'] . '/gallery');
        } else if ($_POST['email'] == '' || $_POST['password'] == '') {
          $_SESSION['error'] = "Please fill in email and password!";
          header('Location:'. $GLOBALS['appurl'] . '/login');
        } else {
          $_SESSION['error'] = "Email or password are not correct! Please try again.";
          header('Location:'. $GLOBALS['appurl'] . '/login');
        } 
      }
    }
    
    /**
     * Creates a User after registration and saves the user to the database
     *
     */
    public function doCreate() {
      
      if (isset($_POST['send'])) {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        
        $password = htmlspecialchars($_POST['password']);
        $password_again = htmlspecialchars($_POST['password-again']);
        $userRepository = new UserRepository();
        $pattern = preg_match('~(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$~', $password);
      
        if ($password != $password_again) {
          $_SESSION['error'] = "Passwords are not equal. Please try again";
          header('Location:'. $GLOBALS['appurl'] . '/login/registration');
        } else if (!$pattern || strlen($password) <8) {
          $_SESSION['error'] = "Password has to contain at least 1 upper case letter, 1 number or special character and must be at least 8 characters in length!";
          header('Location:'. $GLOBALS['appurl'] . '/login/registration');
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $_SESSION['error'] = "Invalid email format!";
          header('Location:'. $GLOBALS['appurl'] . '/login/registration');
        } else if (!$userRepository->checkEmail($email)) {
          $_SESSION['error'] = "This Email is already used!";
          header('Location:'. $GLOBALS['appurl'] . '/login/registration');
        } else {
          $userRepository->create($username, $email, $password);
          header('Location:'. $GLOBALS['appurl'] . '/login/');
        } 
      }
    }
    
    public function delete() {
      $userRepository = new UserRepository();
      $userRepository->deleteById($_GET['id']);
      header('Location: /login');
    }
    
    public function logout() {
      
      // Unset all of the session variables.
      $_SESSION = array();
      
      /* If it's desired to kill the session, also delete the session cookie.
       * Note: This will destroy the session, and not just the session data!
       *
       */
      if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]
        );
      }
      // Finally, destroy the session.
      session_destroy();
      header('Location:'. $GLOBALS['appurl'] . '/login');
    }
		
		public function galleries() {
			$galleryRepository = new GalleryRepository();
    	$pictureRepository = new PictureRepository();
    
    	$view = new View('galleries_public');
    	$view->title = 'Public galleries';
    	$view->heading = 'Public galleries';
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
    
    $view = new View('gallery_public_show');
    $view->title = "Gallery detail";
    $view->heading = "Gallery detail";
    $view->pictures = $pictureRepository->readAll();
    $view->gallery = $galleryRepository->readById($gid);
    
    $view->display();
  }
}
?>