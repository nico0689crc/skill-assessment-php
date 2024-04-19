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
          Application::list_books();
          break;
        case 2:
          Application::list_other_resources();
          break;
        case 3:
          Application::create_books();
          break;
        case 4:
          Application::create_other_resources();
          break;
        default:
          echo "Your selection did not match with any option. Bye asshole! \n";
      }
    }

    // Book's methods

    private static function list_books() {
      $books = Book::list();

      foreach ($books as $book) {
        echo "ID: {$book->id}, ISBN: {$book->isbn}, Book's Title: {$book->name}, ISBN: {$book->isbn}, Publisher: {$book->publisher}, Author: {$book->author} \n";
      }
    }

    private static function create_books() {
      Book::create();

      echo self::set_color_to_text("Book created succesfully. \n", "GREEN");
    }

    // Other Resource's methods

    private static function list_other_resources() {
      $resources = OtherResource::list();

      foreach ($resources as $resource) {
        echo "ID: {$resource->id}, Resource's Name: {$resource->name}, Brand: {$resource->brand}, Description: {$resource->description} \n";
      }
    }

    private static function create_other_resources() {
      OtherResource::create();

      echo self::set_color_to_text("Resource created succesfully. \n", "GREEN");
    }


    public static function set_color_to_text($text, $color) {
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