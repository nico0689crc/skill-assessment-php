<?php 
  class Main {
    private $book_file_path = 'data/books.json';
    
    function __construct() {}

    function initialize() {
      echo "Insert the action you want to perform: \n";
      echo "** 1 - List Books \n";
      echo "** 2 - Create Books \n";

      $handle = fopen ("php://stdin","r");
      $option = fgets($handle);

      switch ($option) {
        case 1:
          $this->list_books();
          break;
        case 2:
          $this->create_book();
          break;
        default:
          echo "Your selection did not match with any option. Bye asshole! \n";
      }
    }

    private function list_books() {
      $books = Book::list_books($this->book_file_path);

      foreach ($books as $book) {
        echo "ISBN: {$book->isbn}, Book's Title: {$book->name}, ISBN: {$book->isbn}, Publisher: {$book->publisher}, Author: {$book->author} \n";
      }
    }

    private function create_book() {
      echo "Book created \n";
    }
  }
?>