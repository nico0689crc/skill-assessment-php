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

    public function getName() {
      return $this->name;
    }

    public function getType() {
      return $this->type;
    }

    abstract protected static function list() : Array;

    abstract protected static function create() : void;

    abstract protected static function delete() : void;
    
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
          $data = [];
        }

        return $data;
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }

    protected static function currentLibraryResourceID() {
      try {
        $resources = self::readResourcesFromJson();
        $resources_size = count($resources);

        $last_resource = $resources[$resources_size - 1];

        $last_resource_id = (int)$last_resource['id'] + 1;

        return $last_resource_id;
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }
  }
?>