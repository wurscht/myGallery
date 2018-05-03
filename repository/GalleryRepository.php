<?php

require_once '../lib/Repository.php';

class GalleryRepository extends Repository {
  
  protected $tableName = 'gallery';
  
  public function create($name, $description, $uid) {
    
    $query = "INSERT INTO $this->tableName (name, description, uid) VALUES (?,?,?)";
    
    $statement = ConnectionHandler::getConnection()->prepare($query);
    $statement->bind_param('ssi', $name, $description, $uid);
    $statement->execute();
    
    /*if (!statement->execute()) {
      throw new Exception($statement->error);
    } */
    
    return $statement->insert_id;
  }
  
  public function edit($id, $name, $description)
    {
        $query = "UPDATE $this->tableName SET name = ?, description = ? WHERE id = ?";
            
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if($statement === false)
            echo ConnectionHandler::getConnection()->error;
        $statement->bind_param('ssi', $name, $description, $id);
        
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        return $statement->insert_id;    
    }
  
  /*public function getGalleryId($name, $uid) {
    
    $query = "SELECT uid FROM $this->tableName WHERE name = ? AND uid = ?";
    
    $statement = ConnectionHandler::getConnection()->prepare($query);
    $statement->bind_param('si', $name, $uid);
    $statement->execute();
    
    if (!$statement->execute()) {
        throw new Exception($statement->error);
      }
    
    $result = $statement->get_result();
      $row = $result->fetch_object();
      
      return $row->gid;
    
  }*/
}