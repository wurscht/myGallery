<?php
require_once '../lib/Repository.php';
/**
 * Datenbankschnittstelle für die Benutzer
 */
  class UserRepository extends Repository
  {
    protected $tableName = 'user';
    
    public function create($username, $email, $password) {
      
      // creates hash for password
      $password = md5($password);
      
      $query = "INSERT INTO $this->tableName (username, email, password) VALUES (?, ?, ?)";
      
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('sss', $username, $email, $password);
      
      if (!$statement->execute()) {
        throw new Exception($statement->error);
      }
      
      return $statement->insert_id;
    }
    
    public function getUserId($email, $password) {
        $db = getValue('bilderdb');
        $email = strtolower($email);
        $result = $db->query("SELECT uid FROM user WHERE lower(email)='".$email."' AND password='".md5($password)."'");
        if ($user = $result->fetchArray()) return $user[0];
        else return 0;
    }
  }
?>