<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Inventory.php";

    $server = 'mysql:host=localhost;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class InventoryTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Inventory::deleteAll();
        }

        function test_save()
        {
            //arrange
            $name = "Book";
            $test_inventory = new Inventory($name);

            //act
            $test_inventory->save();

            //assert
            $result = Inventory::getAll();
            $this->assertEquals($test_inventory, $result[0]);
        }

        function test_getAll()
        {
            //arrange
            $name  = "Book";
            $name2 = "Paper";
            $test_inventory = new Inventory($name);
            $test_inventory->save();
            $test_inventory2 = new Inventory($name2);
            $test_inventory2->save();

            // act
            $result = Inventory::getAll();

            //assert
            $this->assertEquals([$test_inventory, $test_inventory2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Book";
            $name2 = "Paper";
            $test_inventory = new Inventory($name);
            $test_inventory->save();
            $test_inventory2 = new Inventory($name2);
            $test_inventory2->save();

            //Act
            Inventory::deleteAll();

            //Assert
            $result = Inventory::getAll();
            $this->assertEquals([], $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Book";
            $id = 1;
            $test_Inventory = new Inventory($name, $id);

            //Act
            $result = $test_Inventory->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Book";
            $name2 = "Paper";
            $test_inventory = new Inventory($name);
            $test_inventory->save();
            $test_inventory2 = new Inventory($name2);
            $test_inventory2->save();

            //Act
            $id = $test_inventory->getId();
            $result = Inventory::find($id);

            //Assert
            $this->assertEquals($test_inventory, $result);
        }

    }
?>
