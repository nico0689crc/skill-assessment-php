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

    public static function list() : Array {
      try {
        $other_resources = [];
        $data = parent::read_resources_from_json();
  
        foreach ($data as $item) {
          if(isset($item['type']) and $item['type'] == self::$type) {
            $other_resources[] = new OtherResource($item['id'], $item['name'], $item['description'], $item['brand']);
          }
        }
        
        return $other_resources;
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }

    public static function create() : void { }
  }
?>