<?php 
  class Application {

    public static function initialize() {
      echo "Insert the action you want to perform: \n";
      echo "** 1 - List Books \n";
      echo "** 2 - List Other Resources \n";
      echo "** 3 - Create Books \n";
      echo "** 4 - Create Other Resources \n";

      $handle = fopen ("php://stdin","r");
      $option = fgets($handle);

      switch ($option) {
        case 1:
          Application::listBooks();
          break;
        case 2:
          Application::listOtherResources();
          break;
        case 3:
          Application::createBooks();
          break;
        case 4:
          Application::createOtherResources();
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