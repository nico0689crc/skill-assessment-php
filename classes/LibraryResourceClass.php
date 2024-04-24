<?php 
  abstract class LibraryResource {
    public $id;
    public $name;
    public $type;
    
    protected static $resourcesFilePath = 'data/resources.json';

    public function __construct($id, $name) {
      $this->id = $id;
      $this->name = $name;
    }

    abstract public static function list() : Array;

    abstract public static function create() : void;

    public static function delete($resource_id) {
      try {
        $resources = self::readResourcesFromJson();

        print_r($resources);
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }
    
    protected static function saveResourcesToJson($resources) {
      try {
        $json_data = json_encode($resources, JSON_PRETTY_PRINT);
        file_put_contents(self::$resourcesFilePath, $json_data);
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }

    protected static function readResourcesFromJson() {
      try {
        $json_data = file_get_contents(self::$resourcesFilePath);
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