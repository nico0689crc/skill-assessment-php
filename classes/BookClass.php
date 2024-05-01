<?php 
  class Book extends LibraryResource {
    private static $entity = "BOOK";
    
    private $isbn;
    private $publisher;
    private $author;

    public function __construct($id, $name, $isbn, $publisher, $author) {
      $this->id = $id;
      $this->name = $name;
      $this->isbn = $isbn;
      $this->publisher = $publisher;
      $this->author = $author;
      $this->type = self::$entity;
    }

    public function getIsbn() {
      return $this->isbn;
    }

    public function getPublisher() {
      return $this->publisher;
    }

    public function getAuthor() {
      return $this->author;
    }

    public static function list() : Array {
      try {
        $books = [];
        $resources = parent::readResourcesFromJson();
  
        foreach ($resources as $resource) {
          if(isset($resource['type']) and $resource['type'] == self::$entity) {
            $books[] = new Book($resource['id'], $resource['name'], $resource['isbn'], $resource['publisher'], new Author($resource['author']['id'], $resource['author']['name']));
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
        $author_input = readline(Application::setColorToText("Insert the Author of the book: ", "GREEN"));

        $author = new Author(1, $author_input);
        $book = new Book($id, $name, $isbn, $publisher, $author);

        $resources[] = Array(
          "id" => $book->getId(),
          "name" => $book->getName(),
          "type" => $book->getType(),
          "isbn" => $book->getIsbn(),
          "publisher" => $book->getPublisher(),
          "author" => Array(
            "id" => $book->getAuthor()->getId(),
            "name" => $book->getAuthor()->getName(),
          )
        );

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

    public static function searchByID() {
      $books = self::list();
      $index = -1;

      $book_id = readline(Application::setColorToText("Insert the ID of the Book to search: ", "GREEN"));

      foreach ($books as $key => $book) {
        if($book->id == $book_id){
          $index = $key;
          break;
        }
      }

      if($index >= 0) {
        return $books[$index];
      } else {
        return false;
      }
    }
  }
?>