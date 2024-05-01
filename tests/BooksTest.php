<?php
  use PHPUnit\Framework\TestCase; 
  include __DIR__ . '/../classes/includes.php';

  class BooksTest extends TestCase {

    // It should create a Book object and throw an error message when trying to acccess to a private property.
    public function testBookPropertyAccess() {
      $id = 1;
      $name = "Test Book";
      $isbn = "978-3-16-148410-0";
      $publisher = "Test Publisher";
      $author = new Author(1, "Test Author");

      $book = new Book($id, $name, $isbn, $publisher, $author);

      $errorMessage = '';
      try {
        $isbn = $book->isbn; 
      } catch (Error $error) {
        $errorMessage = $error->getMessage();
      }

      $this->assertNotEmpty($errorMessage);
      $this->assertStringContainsString('Cannot access private property', $errorMessage);
    }
    
    
    // It should create a Book object and access to its properties and heritage properties through their getters.
    public function testCreateBook() {
      $id = 1;
      $name = "Test Book";
      $isbn = "978-3-16-148410-0";
      $publisher = "Test Publisher";
      $author = new Author(1, "Test Author");

      $book = new Book($id, $name, $isbn, $publisher, $author);

      $this->assertInstanceOf(Book::class, $book);
      $this->assertEquals($id, $book->getId());
      $this->assertEquals($name, $book->getName());
      $this->assertEquals($isbn, $book->getIsbn());
      $this->assertEquals($publisher, $book->getPublisher());
      $this->assertEquals($author, $book->getAuthor());
    }

  }
?>