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
      if (isset($_POST['send']) && $_Post['send']) {
        $error = false;
        $errors = [];
        $userRepository = new UserRepository();
        $user = $userRepository->getUser($_POST['email']);
        $password = $userRepository-getPassword($_POST['email']);
        var_dump($password);
        if ($user && $password == $_POST['password']) {
          echo "Juhu";
        } else {
          echo "Faaaaautsch";
        }
      }
      
    }
    
    public function doCreate() {
      if ($_POST['send']) {
          $username = htmlspecialchars($_POST['username']);
          $email = htmlspecialchars($_POST['email']);
          $password = htmlspecialchars($_POST['password']);
          $password_again = htmlspecialchars($_POST['password-again']);
          if ($password == $password_again) {
            $userRepository = new UserRepository();
            $userRepository->create($username, $email, $password);
          }
          
      }
      // Anfrage an die URI /user weiterleiten (HTTP 302)
      header('Location:'. $GLOBALS['appurl'] . '/login/');
    }
    
    public function delete() {
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);
        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /login');
    }
}
?>