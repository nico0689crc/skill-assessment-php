<?php 
  class Book extends LibraryResource {
    public $isbn;
    public $publisher;
    public $author;
    private static $type = "BOOK"; 

    public function __construct($id, $name, $isbn, $publisher, $author) {
      $this->id = $id;
      $this->name = $name;
      $this->isbn = $isbn;
      $this->publisher = $publisher;
      $this->author = $author;
    }
    
    public function add_resource () : string {
      return "BookClass\n";
    }

    public static function list($file_path) : Array {
      $books = [];
      $json_data = file_get_contents($file_path);
      $data = json_decode($json_data, true);
      
      if ($data == null) {
        echo "Error decoding JSON file.";
      }

      foreach ($data as $item) {
        if(isset($item['type']) and $item['type'] == self::$type) {
          $books[] = new Book($item['id'], $item['name'], $item['isbn'], $item['publisher'], $item['author']);
        }
      }
      
      return $books;
    }
  }
?>