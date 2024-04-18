<?php 
  class OtherResource extends LibraryResource {
    public $description;
    public $brand;

    public function __construct($id, $name, $description, $brand) {
      $this->id = $id;
      $this->name = $name;
      $this->description = $description;
      $this->brand = $brand;
    }

    public function add_resource () : string {
      return "OtherResource";
    }
  }
?>