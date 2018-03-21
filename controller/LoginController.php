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
    echo "<p>Wurscht<p>";
        
    if ($_POST['send'] && isset($_POST['email']) && isset($_POST['passwort'])) {
        $error = false;
        $errors = [];
        $userRepository = new UserRepository();
        if ($userRepository->getUserId($_POST['email'], $_POST['passwort']) == 0) {
            echo "<div class='error-message col-md-6 offset-md-3'>";
            echo "<p class='alert alert-danger'>Bitte geben Sie eine gültige E-Mail Adresse und Passwort ein</p>";
            echo "</div>";
        } elseif ($userRepository->getUserId($_POST['email'], $_POST['passwort']) > 0) {
            $_SESSION['userId'] = getUserId($_POST['email'], $_POST['passwort']);
            var_dump($_SESSION['userId']);
            //header ("Location: index.php?function=blogs_member&bid=0");
        }
    }
       /* 
      if (isset($_POST['send']) && $_Post['send']) {
        
        $user = $userRepository->getUser($_POST['email']);
        $password = $userRepository-getPassword($_POST['email']);
        var_dump($password);
        if ($user && $password == $_POST['password']) {
          echo "Juhu";
        } else {
          echo "Faaaaautsch";
        }
      }
        */
      
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