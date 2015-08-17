<?php

    class Inventory {

        private $name;

        function __construct($name) {
            $this->name = $name;
        }

        function setName($new_name) {
            $this->name = (string) $new_name;
         }

         function getName() {
             return $this->name;
         }

         function save() {
             $GLOBALS['DB']->exec("INSERT INTO inventories (name) VALUES ('{$this->getName()}');");
         }

         static function getAll()
          {
            $returned_inventories = $GLOBALS['DB']->query("SELECT * FROM inventories;");
            $inventories = array();
            foreach($returned_inventories as $inventory) {
              $name = $inventory['name'];
              $new_inventory = new Inventory($name);
              array_push($inventories, $new_inventory);
            }
            return $inventories;
          }

          static function deleteAll()
            {
                $GLOBALS['DB']->exec("DELETE FROM inventories;");
            }

     }
?>
