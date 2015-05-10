<?php
class ItemValue
{
    private $Id;
    private $Value;
    private $Description;


    public function getId() {
        return $this->Id;
    } 
    public function getValue() {
        return $this->Value;
    }
    
    public function getDescription() {
        return $this->Description;
    }

     public function setId($id) {
        $this->Id = $id;
    }
    
     public function setValue($Value) {
        $this->Value = $Value;
    }
    
     public function setDescription($Description) {
        $this->Description = $Description;
    }
}
?>
