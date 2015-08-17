<?php

    class Inventory {

        private $name;
        private $id;

        function __construct($name, $id = null) {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($new_name) {
            $this->name = (string) $new_name;
         }

         function getName() {
             return $this->name;
         }

         function save() {
             $GLOBALS['DB']->exec("INSERT INTO inventories (name) VALUES ('{$this->getName()}');");
             $this->id = $GLOBALS['DB']->lastInsertId();
         }

         static function getAll()
          {
            $returned_inventories = $GLOBALS['DB']->query("SELECT * FROM inventories;");
            $inventories = array();
            foreach($returned_inventories as $inventory) {
              $name = $inventory['name'];
              $id = $inventory['id'];
              $new_inventory = new Inventory($name, $id);
              array_push($inventories, $new_inventory);
            }
            return $inventories;
          }

          static function deleteAll()
            {
                $GLOBALS['DB']->exec("DELETE FROM inventories;");
            }

            function getId()
            {
                return $this->id;
            }

            static function find($search_id)
            {
                $found_inventory = null;
                $inventories = Inventory::getAll();
                foreach($inventories as $inventory) {
                    $inventory_id = $inventory->getId();
                    if ($inventory_id == $search_id) {
                        $found_inventory = $inventory;
                    }
                }
                return $found_inventory;
            }

     }
?>
