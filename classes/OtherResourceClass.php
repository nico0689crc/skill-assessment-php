<?php 
  class OtherResource extends LibraryResource {
    private static $entity = "OTHER";

    public $description;
    public $brand;

    public function __construct($id, $name, $description, $brand) {
      $this->id = $id;
      $this->name = $name;
      $this->description = $description;
      $this->brand = $brand;
      $this->type = self::$entity;
    }

    public static function list() : Array {
      try {
        $other_resources = [];
        $data = parent::read_resources_from_json();
  
        foreach ($data as $item) {
          if(isset($item['type']) and $item['type'] == self::$entity) {
            $other_resources[] = new OtherResource($item['id'], $item['name'], $item['description'], $item['brand']);
          }
        }
        
        return $other_resources;
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }

    public static function create() : void { 
      try {
        $resources = parent::read_resources_from_json();
        $handle = fopen ("php://stdin","r");

        $id = count($resources) + 1;

        echo Application::set_color_to_text("Insert the Name of the resource: \n", "GREEN");
        $name = rtrim(fgets($handle), "\r\n");

        echo Application::set_color_to_text("Insert the Description of the resource: \n", "GREEN");
        $description = rtrim(fgets($handle), "\r\n");

        echo Application::set_color_to_text("Insert the Brand of the resource: \n", "GREEN");
        $brand = rtrim(fgets($handle), "\r\n");

        $resources[] = new OtherResource($id, $name, $description, $brand);

        parent::save_resources_to_json($resources);
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }
  }
?>