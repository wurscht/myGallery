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
    
    public function getUser($email) {
      $query = "SELECT * FROM $this->tableName WHERE email = ?";
      
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->execute();

      $result = $statement->get_result();
      if (!$result) {
        throw new Exception($statement->error);
      }
    }
    
    public function getPassword($email) {
      $query = "SELECT password FROM $this->tableName WHERE email = ?";
      
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->execute();
      
      $result = $statement->get_result();
      if (!$result) {
        throw new Exception($statement->error);
      } else {
        return $result;
      }
    }
    
  }
?>