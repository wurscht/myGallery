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
      $options = [
        'cost' => 12,
      ];
      
      $password = password_hash($password, PASSWORD_BCRYPT, $options);
      
      $query = "INSERT INTO $this->tableName (username, email, password) VALUES (?, ?, ?)";
      
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('sss', $username, $email, $password);
      
      if (!$statement->execute()) {
        throw new Exception($statement->error);
      }
      
      return $statement->insert_id;
    }
    
    public function getUserId($email, $password) {
      
      $query = "SELECT uid FROM $this->tableName WHERE email = ? AND password = ?";
      
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('ss', $email, $password);
      $statement->execute();
      
      
      
      //if (!$statement->execute()) {
      //  throw new Exception($statement->error);
      //}
      
      $result = $statement->get_result();
      $row = $result->fetch_object();
      
      return $row->uid;
    }
    
    public function getPasswordHash($email) {
      
      $query = "SELECT password FROM $this->tableName WHERE email = ?";
      
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('s', $email);
      $statement->execute();
      
      $result = $statement->get_result();
      $row = $result->fetch_object();
      return $row->password;
    }
    
    public function checkEmail($email) {
      $query = "SELECT email FROM $this->tableName WHERE email = ?";
      
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('s', $email);
      $statement->execute();
    
      $result = $statement->get_result();
      
      if ($result->num_rows < 1 ) {
        return true;
      } 
      return false;
      
    }
  }
?>