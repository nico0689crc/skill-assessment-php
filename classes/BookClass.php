<?php 
  class Book extends LibraryResource {
    public $isbn;
    public $publisher;
    public $author; 

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

    public static function list_books($file_path) {
      $books = [];
      $json_data = file_get_contents($file_path);
      $data = json_decode($json_data, true);
      
      if ($data !== null) {
        foreach ($data as $item) {
          $book = new Book($item['id'], $item['name'], $item['isbn'], $item['publisher'], $item['author']);
          $books[] = $book;
        }
      } else {
        echo "Error decoding JSON file.";
      }
      
      return $books;
    }
  }
?>