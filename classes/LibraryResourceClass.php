<?php 
  abstract class LibraryResource {
    public $id;
    public $name;
    protected static $resources_file_path = 'data/resourcess.json';

    public function __construct($id, $name) {
      $this->id = $id;
      $this->name = $name;
    }

    abstract public static function list() : Array;

    abstract public static function create() : void;
    
    protected static function save_resources_to_json($resources) {
      try {
        $json_data = json_encode($resources, JSON_PRETTY_PRINT);
        file_put_contents(self::$resources_file_path, $json_data);
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }

    protected static function read_resources_from_json() {
      try {
        $json_data = file_get_contents(self::$resources_file_path);
        $data = json_decode($json_data, true);
        
        if ($data == null) {
          throw new Exception("JSON File cannot be found. \n");
        }
  
        return $data;
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }
  }
?>