<?php

require_once '../lib/Repository.php';

class GalleryRepository extends Repository {
  
  protected $tableName = 'gallery';
  
  public function create($name, $description) {
    
    $query = "INSERT INTO $this->tableName (name, description) VALUES (?,?)";
    
    $statement = ConnectionHandler::getConnection()->prepare($query);
    $statement->bind_param('ss', $name, $description);
    
    if (!statement->execute()) {
      throw new Exception($statement->error);
    }
    
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
}