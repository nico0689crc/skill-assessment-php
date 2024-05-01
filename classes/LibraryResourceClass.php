<?php 
  abstract class LibraryResource {
    protected $id;
    protected $name;
    protected $type;
    
    protected static $resourcesFilePath = 'data/resources.json';

    public function __construct($id, $name) {
      $this->id = $id;
      $this->name = $name;
    }

    public function getId() {
      return $this->id;
    }

    public function setId($id) {
      $this->id = $id;
    }

    public function getName() {
      return $this->name;
    }

    public function getType() {
      return $this->type;
    }

    abstract public static function list() : Array;

    abstract public static function create() : void;

    abstract public static function delete() : void;
    
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