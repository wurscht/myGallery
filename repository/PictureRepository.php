<?php

require_once '../lib/Repository.php';

class PictureRepository extends Repository {
  
  protected $tableName = 'picture';
  
  public function preview($gid) {
    
    $query = "SELECT path FROM $this->tableName WHERE git = ? LIMIT 1";
    
    $statement = ConnectionHandler::getConnection()->prepare($query);
    $statement->bind_param('i', $gid);
    $statement->execute();
    
    if (!$statement->execute()) {
        throw new Exception($statement->error);
    }
    
    $result = $statement->get_result();
    $row = $result->fetch_object();
      
    return $row->uid; 
  }
  
  public function create($name, $path, $thumb_path, $gid) {
    
    $query = "INSERT INTO $this->tableName (name, path, thumb_path, gid) VALUES (?,?,?,?)";
    
    $statement = ConnectionHandler::getConnection()->prepare($query);
    $statement->bind_param('sssi', $name, $path, $thumb_path, $gid);
    $statement->execute();
    
    return $statement->insert_id;
  }
    
  public function deleteById($pid) {
      
    $query = "DELETE FROM {$this->tableName} WHERE pid=?";
    $statement = ConnectionHandler::getConnection()->prepare($query);
    $statement->bind_param('i', $pid);
  
    if (!$statement->execute()) {
      throw new Exception($statement->error);
    }
  }
    
  public function readById($pid) {
      // Query erstellen
    $query = "SELECT * FROM {$this->tableName} WHERE pid=?";
  
    $statement = ConnectionHandler::getConnection()->prepare($query);
    $statement->bind_param('i', $pid);
  
    $statement->execute();
  
    $result = $statement->get_result();
    if (!$result) {
      throw new Exception($statement->error);
    }
  
    $row = $result->fetch_object();
  
    $result->close();
  
    return $row;
  }
  
  public function readAll() {
    
      $query = "SELECT * FROM {$this->tableName}";
      
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->execute();
      
      $result = $statement->get_result();
      if (!$result) {
        throw new Exception($statement->error);
      }
      
      $rows = array();
      while ($row = $result->fetch_object()) {
  		$rows[] = $row;
      }
      return $rows;
    }
    
  public function edit($pid, $name) {
      
    $query = "UPDATE $this->tableName SET name = ? WHERE pid = ?";
            
    $statement = ConnectionHandler::getConnection()->prepare($query);
    if($statement === false) {
      echo ConnectionHandler::getConnection()->error;
    }
    $statement->bind_param('si', $name, $pid);
        
    if (!$statement->execute()) {
      throw new Exception($statement->error);
    }
    return $statement->insert_id;    
  }
}