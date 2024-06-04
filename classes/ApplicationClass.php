<?php 
  class Application {

    public static function initialize() {
      echo "Insert the action you want to perform: \n";

      echo self::setColorToText("*****************************\n", "GREEN");
      echo self::setColorToText("*****        BOOK       *****\n", "GREEN");
      echo self::setColorToText("*****************************\n", "GREEN");

      echo "** 1 - List Books \n";
      echo "** 2 - Create Books \n";
      echo "** 3 - Delete Book by ID \n";
      echo "** 4 - Search Book by ID \n";
      echo "** 5 - Sort Books in Ascending Order \n";
      echo "** 6 - Sort Books in Descending Order \n";

      echo self::setColorToText("*****************************\n", "GREEN");
      echo self::setColorToText("*****    RESOURECES     *****\n", "GREEN");
      echo self::setColorToText("*****************************\n", "GREEN");

      echo "** 7 - List Other Resources \n";
      echo "** 8 - Create Other Resource \n";
      echo "** 9 - Delete Resource by ID \n";

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
          echo "Your selection did not match with any option. \n";
      }
    }

    // Book's methods

    private static function listBooks() {
      $books = Book::list();

      if(count($books) > 0){
        foreach ($books as $book) {
          echo "ID: {$book->getId()}, Book's Title: {$book->getName()}, ISBN: {$book->getIsbn()}, Publisher: {$book->getPublisher()}, Author: {$book->getAuthor()->getName()} \n";
        }
      } else {
        echo self::setColorToText("There are any Book to list. \n", "RED");
      }
    }

    private static function createBooks() {
      Book::create();

      echo self::setColorToText("Book created succesfully. \n", "GREEN");
    }

    private static function deleteBook() {
      Book::delete();
    }

    private static function searchBook() {
      $book = Book::searchByID();

      if($book !== false){
        echo "ID: {$book->getId()}, Book's Title: {$book->getName()}, ISBN: {$book->getIsbn()}, Publisher: {$book->getPublisher()}, Author: {$book->getAuthor()->getName()} \n";
      } else {
        echo self::setColorToText("Book could not be found. \n", "RED");
      }
    }

    // Other Resource's methods

    private static function listOtherResources() {
      $resources = OtherResource::list();

      if(count($resources) > 0){
        foreach ($resources as $resource) {
          echo "ID: {$resource->getId()}, Resource's Name: {$resource->getName()}, Brand: {$resource->getBrand()}, Description: {$resource->getDescription()} \n";
        }
      } else {
        echo self::setColorToText("There are any OtherResource to list. \n", "RED");
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

      if(count($books) > 0){
        foreach ($books as $book) {
          echo "ID: {$book->getId()}, Book's Title: {$book->getName()}, ISBN: {$book->getIsbn()}, Publisher: {$book->getPublisher()}, Author: {$book->getAuthor()->getName()} \n";
        }
      } else {
        echo self::setColorToText("There are any Book to list sorted. \n", "RED");
      }
    }

    private static function sortBooksDesc() {
      $books = Book::sort("DESC");

      if(count($books) > 0){
        foreach ($books as $book) {
          echo "ID: {$book->getId()}, Book's Title: {$book->getName()}, ISBN: {$book->getIsbn()}, Publisher: {$book->getPublisher()}, Author: {$book->getAuthor()->getName()} \n";
        }
      } else {
        echo self::setColorToText("There are any Book to list sorted. \n", "RED");
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