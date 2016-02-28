<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

     class StylistTest extends PHPUnit_Framework_TestCase
     {

        protected function tearDown()
        {
          Client::deleteAll();
          Stylist::deleteAll();
        }

        function test_save()
         {
            //Arrange
            $name = "Sara";
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals($test_Stylist, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Sara";
            $name2 = "Brian";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function test_getClients()
        {
          //Arrange
          $name = "Bill";
          $id = null;
          $test_stylist = new Stylist($name, $id);
          $test_stylist->save();

          $name1 = "Goff Uckyrself";
          $age = 10;
          $hairstyle = "short";
          $stylist_id = $test_stylist->getId();
          $test_client = new Client($id, $name1, $age, $hairstyle, $stylist_id);
          $test_client->save();

          $name2 = "Jim James";
          $age2 = 30;
          $hairstyle2 = "long and curly";
          $stylist_id2 = $test_stylist->getId();
          $test_client2 = new Client($id, $name2, $age2, $hairstyle2, $stylist_id2);
          $test_client2->save();

          //Act
          $result = $test_stylist->getClients();

          //Assert
          $this->assertEquals([$test_client, $test_client2], $result);
        }



        function test_deleteAll()
        {
            //Arrange
            $name = "Sara";
            $name2 = "Brian";
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();
            $test_Stylist2 = new Stylist($name2);
            $test_Stylist2->save();

            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([], $result);
         }

         function test_find()
         {
             //Arrange
             $name = "Sara";
             $name2 = "Brian";
             $test_Stylist = new Stylist($name);
             $test_Stylist->save();
             $test_Stylist2 = new Stylist($name2);
             $test_Stylist2->save();

             //Act
             $result = Stylist::find($test_Stylist->getId());

             //Assert
             $this->assertEquals($test_Stylist, $result);
         }

         function testUpdate()
         {
            //Arrange
            $name = "James";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $new_name = "Sara";

            //Act
            $test_stylist->update($new_name);

            //Assert
            $this->assertEquals("Sara", $test_stylist->getName());
          }

          function testDelete()
        {
            //Arrange
            $name = "James";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name2 = "Sara";
            $test_stylist2 = new Stylist($name2, $id);
            $test_stylist2->save();


            //Act
            $test_stylist->delete();

            //Assert
            $this->assertEquals([$test_stylist2], Stylist::getAll());
        }

        function testDelete_StylistClients()
        {
            //Arrange
            $name = "Mexican";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name = "Javiers";
            $age = 10;
            $hairstyle = "long and curly";
            $stylist_id = $test_stylist->getId();
            $test_stylist = new Client($id, $name, $age, $hairstyle, $stylist_id);
            $test_stylist->save();


            //Act
            $test_stylist->delete();

            //Assert
            $this->assertEquals([], Client::getAll());
        }

    }
?>
