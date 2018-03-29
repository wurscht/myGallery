<?php
require_once '../repository/UserRepository.php';
/**
 * Controller für das Login und die Registration, siehe Dokumentation im DefaultController.
 */
  class LoginController
  {
    /**
     * Default-Seite für das Login: Zeigt das Login-Formular an
	 * Dispatcher: /login
     */
    public function index()
    {
      $view = new View('login_index');
      $view->title = 'MyGallery';
      $view->heading = 'Login';
      $view->display();
    }
    /**
     * Zeigt das Registrations-Formular an
	 * Dispatcher: /login/registration
     */
    public function registration()
    {
      $view = new View('login_registration');
      $view->title = 'MyGallery';
      $view->heading = 'Registration';
      $view->display();
    }
    
    /*
    public function register() {
      if ($_POST)
    }
    */
    
    
    /**
     *Funktion zum Ausführen des Logins
     *
     */
    public function login() {
        
      if ($_POST['send'] && isset($_POST['email']) && isset($_POST['password'])) {
          $error = false;
          $errors = [];
          $userRepository = new UserRepository();
          var_dump($_POST);
          var_dump(md5($_POST['password']));
          $userId = $userRepository->getUserId($_POST['email'], md5($_POST['password']));
          if ($userId > 0) {
              $_SESSION['userId'] = $userId;
              header('Location:'. $GLOBALS['appurl'] . '/gallery');
          } else {
              $_SESSION['error'] = "Email or password are not correct. Please try again.";
              header('Location:'. $GLOBALS['appurl'] . '/login');
          } 
      }
    }
    
    public function doCreate() {
      if (isset($_POST['send'])) {
          $username = htmlspecialchars($_POST['username']);
          $email = htmlspecialchars($_POST['email']);
          
          $password = htmlspecialchars($_POST['password']);
          $password_again = htmlspecialchars($_POST['password-again']);
          $userRepository = new UserRepository();
          $pattern = preg_match('(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$', $password);
        
          if ($password != $password_again) {
            $_SESSION['error'] = "Passwords are not equal. Please try again";
            header('Location:'. $GLOBALS['appurl'] . '/login/registration');
          } else if (!pattern || strlen($password) <8) {
            $_SESSION['error'] = "Password has to contain at least 1 upper case letter, 1 number or special character and must be at least 8 characters in length";
            header('Location:'. $GLOBALS['appurl'] . '/login/registration');
          } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Invalid email format";
            header('Location:'. $GLOBALS['appurl'] . '/login/registration');
          } else if (!$userRepository->checkEmail($email)) {
            $_SESSION['error'] = "This Email is already used";
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
        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /login');
    }
    
    public function logout() {
      session_destroy();
      header('Location:'. $GLOBALS['appurl'] . '/login');
    }
}
?>