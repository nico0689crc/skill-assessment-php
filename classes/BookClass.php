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
        $resources = parent::readResourcesFromJson();
  
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
        $resources = parent::readResourcesFromJson();

        $id = count($resources) + 1;
        $name = readline(Application::setColorToText("Insert the Title of the book: ", "GREEN"));
        $isbn = readline(Application::setColorToText("Insert the ISBN of the book: ", "GREEN"));
        $publisher = readline(Application::setColorToText("Insert the Publisher of the book: ", "GREEN"));
        $author = readline(Application::setColorToText("Insert the Author of the book: ", "GREEN"));

        $resources[] = new Book($id, $name, $isbn, $publisher, $author);

        parent::saveResourcesToJson($resources);
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }
    
    public static function delete() : void {
      try {
        $books = parent::readResourcesFromJson();
        $index = -1;

        $book_id = readline(Application::setColorToText("Insert the ID of the Book to delete: ", "GREEN"));

        foreach ($books as $key => $book) {
          if($book['id'] == $book_id and $book['type'] == 'BOOK'){
            $index = $key;
            break;
          }
        }

        if($index >= 0) {
          unset($books[$index]);

          LibraryResource::saveResourcesToJson($books);
  
          echo Application::setColorToText("<< Book of ID ". $book_id ." deleted successfully >> \n", "GREEN");
        } else {
          echo Application::setColorToText("<< Book could not be find >> \n", "RED");
        }
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }

    public static function sort($type) {
      $books = self::list();

      if($type == "ASC") {
        usort($books, function($a, $b) {
          return $a->id - $b->id;
        });
      } else {
        usort($books, function($a, $b) {
          return $b->id - $a->id;
        });
      }

      return $books;
    }
  }
?>