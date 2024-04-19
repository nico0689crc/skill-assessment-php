<?php 
  class Application {
    private static $resources_file_path = 'data/resources.json';

    public static function initialize() {
      echo "Insert the action you want to perform: \n";
      echo "** 1 - List Books \n";
      echo "** 2 - List Other Resources \n";
      echo "** 2 - Create Books \n";

      $handle = fopen ("php://stdin","r");
      $option = fgets($handle);

      switch ($option) {
        case 1:
          Application::list_books();
          break;
        case 2:
          Application::list_other_resources();
          break;
        default:
          echo "Your selection did not match with any option. Bye asshole! \n";
      }
    }

    private static function list_books() {
      $books = Book::list(self::$resources_file_path);

      foreach ($books as $book) {
        echo "ID: {$book->id}, ISBN: {$book->isbn}, Book's Title: {$book->name}, ISBN: {$book->isbn}, Publisher: {$book->publisher}, Author: {$book->author} \n";
      }
    }

    private static function list_other_resources() {
      $resources = OtherResource::list(self::$resources_file_path);

      foreach ($resources as $resource) {
        echo "ID: {$resource->id}, Resource's Name: {$resource->name}, Brand: {$resource->brand}, Description: {$resource->description} \n";
      }
    }

    private static function create_book() {
      echo "Book created \n";
    }
  }
?>