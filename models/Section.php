<?php

class Section extends Model {
    

    public function __construct() {
        
        parent::__construct();
    }
    
    public function getAll()  {
        
        $sth = $this->_db->prepare('SELECT * FROM Sections');
        $sth->execute();
        
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }
}
