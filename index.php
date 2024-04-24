<?php
  include 'classes/includes.php';

  try {
    Application::initialize();
  } catch (Exception $exception) {
    echo Application::setColorToText("Message: " . $exception->getMessage(), "RED");
  }
?>