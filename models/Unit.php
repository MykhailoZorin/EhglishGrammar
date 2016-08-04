<?php

class Unit extends Model {
    
    public function __construct() {
        
        parent::__construct();
    }

    public function getSectionId($unitId) {
        
        $sth = $this->_db->prepare("SELECT sectionId FROM Units WHERE id = $unitId");
        $sth->execute();
        
        $data = $sth->fetch();
        
        return $data['sectionId'];
    }
    
    public function getUnitTitle($unitId) {

        $sth = $this->_db->prepare("SELECT * FROM Units WHERE id = $unitId");
        $sth->execute();
        $data = $sth->fetch();
        
        return $data['name'];
    }

    
    public function getUnits($sectionId) {
        
        $sth = $this->_db->prepare("SELECT * FROM Units WHERE sectionId = $sectionId");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($data);
    }
    
    public function getDescription($unitId) {
        
        $sth = $this->_db->prepare("SELECT * FROM Descriptions WHERE unitId=$unitId");
        $sth->execute();
        $data = $sth->fetch();
        
        return $data['content'];
    }
    
    public function getExercises($unitId) {
        
        $sth = $this->_db->prepare("SELECT * FROM Exercises WHERE unitId=$unitId");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getExerciseNumber($id) {
        
        $sth = $this->_db->prepare("SELECT number FROM Exercises WHERE id=$id");
        $sth->execute();
        
        $data = $sth->fetch();
        
        return $data['number'];
    }
    
    public function getQuestions($exerciseId) {
        
        $sth = $this->_db->prepare("SELECT * FROM Questions WHERE exerciseId=$exerciseId");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;
    }
    
    public function getTextBoxes($questionId) {
        
        $sth = $this->_db->prepare("SELECT * FROM textBoxes WHERE questionId=$questionId");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($data);
        return $data;
    }
    
    public function getAnswerMaxLength($txbId) {
        
        $sth = $this->_db->prepare("SELECT max(length(content)) as maximum FROM Answers WHERE textBoxId=".(integer)$txbId.";");
        
        $data = $sth->execute();
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        
        return $data['maximum'];
    }
    
    public function getAswers($unitId) { 
        
        $sth = $this->_db->prepare("select * from Answers where textBoxId in (select id from textBoxes where questionId in (select id from Questions where exerciseId in (select id from Exercises where unitId=".(integer)$unitId.")))");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($data);
    }
    
    /* Description CRUD */
    public function isDescriptionExists($unitId) {
        
        $sth = $this->_db->prepare("SELECT * FROM Descriptions WHERE unitId=".(integer)$unitId.";");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        return (count($data) == 0) ? false : true;
    }
    
    public function updateDescription($unitId, $content) {
        
//        $c = $this->_db->exec("UPDATE Descriptions SET content='$content' WHERE unitId=".(integer)$unitId.";");
//        echo $c, " records was inserted";

        $sql = "UPDATE Descriptions SET content=? WHERE unitId=?;";
        $q = $this->_db->prepare($sql);
        $c = $q->execute(array($content, $unitId));
        echo $unitId, " was updated";
    }
    /* ************************** */
}
