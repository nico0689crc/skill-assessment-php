<?php 
  class Book extends LibraryResource {
    private static $entity = "BOOK";
    
    public $isbn;
    public $publisher;
    public $author;

    public function __construct($id, $name, $isbn, $publisher, $author) {
      $this->id = $id;
      $this->name = $name;
      $this->isbn = $isbn;
      $this->publisher = $publisher;
      $this->author = $author;
      $this->type = self::$entity;
    }

    public static function list() : Array {
      try {
        $books = [];
        $resources = parent::read_resources_from_json();
  
        foreach ($resources as $resource) {
          if(isset($resource['type']) and $resource['type'] == self::$entity) {
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
        $resources = parent::read_resources_from_json();
        $handle = fopen ("php://stdin","r");

        $id = count($resources) + 1;

        echo Application::set_color_to_text("Insert the Title of the book: \n", "GREEN");
        $name = rtrim(fgets($handle), "\r\n");

        echo Application::set_color_to_text("Insert the ISBN of the book: \n", "GREEN");
        $isbn = rtrim(fgets($handle), "\r\n");

        echo Application::set_color_to_text("Insert the Publisher of the book: \n", "GREEN");
        $publisher = rtrim(fgets($handle), "\r\n");

        echo Application::set_color_to_text("Insert the Author of the book: \n", "GREEN");
        $author = rtrim(fgets($handle), "\r\n");

        $resources[] = new Book($id, $name, $isbn, $publisher, $author);

        parent::save_resources_to_json($resources);
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }
  }
?>