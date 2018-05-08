<?php

require_once '../lib/Repository.php';

class GalleryRepository extends Repository {
  
  protected $tableName = 'gallery';
  
  public function create($name, $description, $uid) {
    
    $query = "INSERT INTO $this->tableName (name, description, uid) VALUES (?,?,?)";
    
    $statement = ConnectionHandler::getConnection()->prepare($query);
    $statement->bind_param('ssi', $name, $description, $uid);
    $statement->execute();
    
    return $statement->insert_id;
  }
  
  public function edit($gid, $name, $description)
    {
        $query = "UPDATE $this->tableName SET name = ?, description = ? WHERE gid = ?";
            
        $statement = ConnectionHandler::getConnection()->prepare($query);
        if($statement === false)
            echo ConnectionHandler::getConnection()->error;
        $statement->bind_param('ssi', $name, $description, $gid);
        
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        return $statement->insert_id;    
    }
  
  public function readById($id)
    {
      // Query erstellen
      $query = "SELECT * FROM {$this->tableName} WHERE gid=?";
  
      // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
      // und die Parameter "binden"
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('i', $id);
  
      // Das Statement absetzen
      $statement->execute();
  
      // Resultat der Abfrage holen
      $result = $statement->get_result();
      if (!$result) {
        throw new Exception($statement->error);
      }
  
      // Ersten Datensatz aus dem Reultat holen
      $row = $result->fetch_object();
  
      // Datenbankressourcen wieder freigeben
      $result->close();
  
      // Den gefundenen Datensatz zurückgeben
      return $row;
    }
}