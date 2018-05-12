<?php
require_once '../lib/Repository.php';
/**
 * Datenbankschnittstelle für die Benutzer
 */
  class UserRepository extends Repository {
    
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
    
    public function edit($id, $username, $email, $password, $isAdmin) {
        
      $options = [
        'cost' => 12,
      ];
      
      $password = password_hash($password, PASSWORD_BCRYPT, $options);
      
      $query = "UPDATE $this->tableName SET username = ?, email = ?, password = ?, isAdmin = ? WHERE uid = ?";
      
      $statement = ConnectionHandler::getConnection()->prepare($query);
      if($statement === false) {
        echo ConnectionHandler::getConnection()->error;
      }
      $statement->bind_param('sssii', $username, $email, $password, $isAdmin, $id);
        
      if (!$statement->execute()) {
          throw new Exception("An error occurs: This email is already used! $statement->error");
      }
      
      return $statement->insert_id;
    }
    
    public function getUserId($email, $password) {
      
      $query = "SELECT uid FROM $this->tableName WHERE email = ? AND password = ?";
      
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('ss', $email, $password);
      $statement->execute();
      
      if (!$statement->execute()) {
        throw new Exception($statement->error);
      }
      
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
    
    public function deleteById($uid) {
      
      $query = "DELETE FROM $this->tableName WHERE uid = ?";
      
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('i', $uid);
  
      if (!$statement->execute()) {
        throw new Exception($statement->error);
      }
    }
    
    public function readAllExceptMyself($uid) {
      
      $query = "SELECT * FROM {$this->tableName} WHERE NOT uid = ?";
      
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('i', $uid);
      $statement->execute();
      
      $result = $statement->get_result();
      if (!$result) {
        throw new Exception($statement->error);
      }
      
      // Datensätze aus dem Resultat holen und in das Array $rows speichern
      $rows = array();
      while ($row = $result->fetch_object()) {
  		$rows[] = $row;
      }
      return $rows;
    }
    
  }
?>