<?php
  include 'classes/includes.php';

  try {
    Application::initialize();
  } catch (Exception $exception) {
    echo Application::set_color_to_text("Message: " . $exception->getMessage(), "BLUE");
  }
?>