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

    public static function list() : Array {
      try {
        $books = [];
        $resources = parent::read_resources_from_json();
  
        foreach ($resources as $resource) {
          if(isset($resource['type']) and $resource['type'] == self::$type) {
            $books[] = new Book($resource['id'], $resource['name'], $resource['isbn'], $resource['publisher'], $resource['author']);
          }
        }
        
        return $books;
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }

    public static function create() : void {
      try {
        $resources = read_resources_from_json();
        $book = new Book($title, $author, $isbn, $pages);
        $resources[] = $book;
        save_resources_to_json($resources);
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }
  }
?>