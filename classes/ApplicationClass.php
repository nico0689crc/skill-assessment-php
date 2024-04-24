<?php 
  class Application {

    public static function initialize() {
      echo "Insert the action you want to perform: \n";

      echo self::setColorToText("*****************************\n", "GREEN");
      echo self::setColorToText("*****        BOOK       *****\n", "GREEN");
      echo self::setColorToText("*****************************\n", "GREEN");

      echo "** 1 - List Books - DONE \n";
      echo "** 2 - Create Books - DONE \n";
      echo "** 3 - Delete Book by ID - DONE \n";
      echo "** 4 - Search Book by ID \n";
      echo "** 5 - Sort Books in Ascending Order - DONE \n";
      echo "** 6 - Sort Books in Descending Order - DONE \n";

      echo self::setColorToText("*****************************\n", "GREEN");
      echo self::setColorToText("*****    RESOURECES     *****\n", "GREEN");
      echo self::setColorToText("*****************************\n", "GREEN");

      echo "** 7 - List Other Resources - DONE \n";
      echo "** 8 - Create Other Resource - DONE \n";
      echo "** 9 - Delete Resource by ID - DONE \n";

      $option = readline(self::setColorToText("Enter your option: ", "YELLOW"));

      switch ($option) {
        case 1:
          Application::listBooks();
          break;
        case 2:
          Application::createBooks();
          break;
        case 3:
          Application::deleteBook();
          break;
        case 4:
          Application::searchBook();
          break;
        case 5:
          Application::sortBooksAsc();
          break;
        case 6:
          Application::sortBooksDesc();
          break;
        case 7:
          Application::listOtherResources();
          break;
        case 8:
          Application::createOtherResources();
          break;
        case 9:
          Application::deleteResource();
          break;
        default:
          echo "Your selection did not match with any option. Bye asshole! \n";
      }
    }

    // Book's methods

    private static function listBooks() {
      $books = Book::list();

      foreach ($books as $book) {
        echo "ID: {$book->id}, ISBN: {$book->isbn}, Book's Title: {$book->name}, ISBN: {$book->isbn}, Publisher: {$book->publisher}, Author: {$book->author} \n";
      }
    }

    private static function createBooks() {
      Book::create();

      echo self::setColorToText("Book created succesfully. \n", "GREEN");
    }

    private static function deleteBook() {
      Book::delete();

      echo self::setColorToText("Book created succesfully. \n", "GREEN");
    }

    private static function searchBook() {
      $book = Book::searchByID();

      if($book !== false){
        echo "ID: {$book->id}, ISBN: {$book->isbn}, Book's Title: {$book->name}, ISBN: {$book->isbn}, Publisher: {$book->publisher}, Author: {$book->author} \n";
      } else {
        echo self::setColorToText("Book could not be found. \n", "RED");
      }
    }

    // Other Resource's methods

    private static function listOtherResources() {
      $resources = OtherResource::list();

      foreach ($resources as $resource) {
        echo "ID: {$resource->id}, Resource's Name: {$resource->name}, Brand: {$resource->brand}, Description: {$resource->description} \n";
      }
    }

    private static function createOtherResources() {
      OtherResource::create();

      echo self::setColorToText("Resource created succesfully. \n", "GREEN");
    }

    private static function deleteResource() {
      OtherResource::delete();
    }

    private static function sortBooksAsc() {
      $books = Book::sort("ASC");

      foreach ($books as $book) {
        echo "ID: {$book->id}, ISBN: {$book->isbn}, Book's Title: {$book->name}, ISBN: {$book->isbn}, Publisher: {$book->publisher}, Author: {$book->author} \n";
      }
    }

    private static function sortBooksDesc() {
      $books = Book::sort("DESC");

      foreach ($books as $book) {
        echo "ID: {$book->id}, ISBN: {$book->isbn}, Book's Title: {$book->name}, ISBN: {$book->isbn}, Publisher: {$book->publisher}, Author: {$book->author} \n";
      }
    }

    public static function setColorToText($text, $color) {
      switch ($color) {
        case 'RED':
          return "\033[0;31m" . $text . "\033[0m";
        case 'GREEN':
          return "\033[0;32m" . $text . "\033[0m";
        case 'YELLOW':
          return "\033[0;33m" . $text . "\033[0m";
        case 'BLUE':
          return "\033[0;34m" . $text . "\033[0m";
        default:
          return $text;
      }
    }
  }
?>