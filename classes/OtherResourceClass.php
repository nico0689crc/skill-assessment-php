<?php 
  class OtherResource extends LibraryResource {
    private static $entity = "OTHER";

    private $description;
    private $brand;

    public function __construct($id, $name, $description, $brand) {
      $this->id = $id;
      $this->name = $name;
      $this->description = $description;
      $this->brand = $brand;
      $this->type = self::$entity;
    }

    public function getDescription() {
      return $this->description;
    }

    public function getBrand() {
      return $this->brand;
    }

    public static function list() : Array {
      try {
        $other_resources = [];
        $data = parent::readResourcesFromJson();
  
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
        $resources = parent::readResourcesFromJson();

        $id = count($resources) + 1;
        $name = readline(Application::setColorToText("Insert the Name of the resource: ", "GREEN"));
        $description = readline(Application::setColorToText("Insert the Description of the resource: ", "GREEN"));
        $brand = readline(Application::setColorToText("Insert the Brand of the resource: ", "GREEN"));

        $other_resources = new OtherResource($id, $name, $description, $brand);

        $resources[] = Array(
          "id" => $other_resources->getId(),
          "name" => $other_resources->getName(),
          "type" => $other_resources->getType(),
          "description" => $other_resources->getDescription(),
          "brand" => $other_resources->getBrand(),
        );

        parent::saveResourcesToJson($resources);
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }

    public static function delete() : void {
      try {
        $other_resources = parent::readResourcesFromJson();
        $index = -1;

        $other_resource_id = readline(Application::setColorToText("Insert the ID of the Other Resource to delete: ", "GREEN"));

        foreach ($other_resources as $key => $other_resource) {
          if($other_resource['id'] == $other_resource_id and $other_resource['type'] == 'OTHER'){
            $index = $key;
            break;
          }
        }

        if($index >= 0) {
          unset($other_resources[$index]);

          LibraryResource::saveResourcesToJson($other_resources);
  
          echo Application::setColorToText("<< Other Resource of ID ". $other_resource_id ." deleted successfully. >> \n", "GREEN");
        } else {
          echo Application::setColorToText("<< Other Resource could not be find. >> \n", "RED");
        }
      } catch (Exception $exception) {
        throw new Exception($exception->getMessage() . "\n");
      }
    }
  }
?>