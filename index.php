<?php
  try {
    include 'classes/includes.php';
    define('CLEAR_CLI', "\033[2J\033[;H");

    do {
      echo CLEAR_CLI;
      Application::initialize();
      $option = readline(Application::setColorToText("Do you want to perform another action? Type 'yes' or 'y' to continue: ", "YELLOW"));
      $option = strtolower(trim($option));
    } while ($option === "yes" || $option === "y");
    
  } catch (Exception $exception) {
    echo Application::setColorToText("Message: " . $exception->getMessage(), "RED");
  }
?>