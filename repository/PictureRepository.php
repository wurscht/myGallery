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
}