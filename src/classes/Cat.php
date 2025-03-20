<?php 
class Cat{
    public $catId;
    public $image;
    public $name;
    public $age;
    public $gender;
    public $breed;
    public $color;
    public $weight;
    public $description;
    public $inboundDate;
    function __construct(
        $catId, $image,$name, $age, $gender, $breed, 
        $color, $weight, $description, $inboundDate){
        $this->catId = $catId;
        $this->image = $image;
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
        $this->breed = $breed;
        $this->color = $color;
        $this->weight = $weight;
        $this->description = $description;
        $this->inboundDate = $inboundDate;
    }
}
?>