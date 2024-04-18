<?php 
  abstract class LibraryResource {
    public $id;
    public $name;

    public function __construct($id, $name) {
      $this->id = $id;
      $this->name = $name;
    }

    abstract public function add_resource() : string;
  }
?>