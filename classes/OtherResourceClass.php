<?php 
  class OtherResource extends LibraryResource {
    public $description;
    public $brand;
    private static $type = "OTHER"; 

    public function __construct($id, $name, $description, $brand) {
      $this->id = $id;
      $this->name = $name;
      $this->description = $description;
      $this->brand = $brand;
    }

    public static function list($file_path) : Array {
      $other_resources = [];
      $json_data = file_get_contents($file_path);
      $data = json_decode($json_data, true);
      
      if ($data == null) {
        echo "Error decoding JSON file.";
      }

      foreach ($data as $item) {
        if(isset($item['type']) and $item['type'] == self::$type) {
          $other_resources[] = new OtherResource($item['id'], $item['name'], $item['description'], $item['brand']);
        }
      }
      
      return $other_resources;
    }

    public function add_resource () : string {
      return "OtherResource";
    }
  }
?>