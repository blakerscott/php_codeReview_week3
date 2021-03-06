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


      class ClientTest extends PHPUnit_Framework_TestCase
      {
         protected function tearDown()
         {
             Client::deleteAll();
             Stylist::deleteAll();
         }


       function test_save()
        {
           //Arrange
           $name = "Bill";
           $id = null;
           $test_stylist = new Stylist($name, $id);
           $test_stylist->save();
           var_dump($test_stylist);

           $name2 = "Goff Uckyrself";
           $age = 10;
           $hairstyle = "short";
           $stylist_id = $test_stylist->getId();
           $test_client = new Client($id, $name2, $age, $hairstyle, $stylist_id);
           $test_client->save();

           //Act
           $result = Client::getAll();
           //Assert
           $this->assertEquals($test_client, $result[0]);
        }

       function test_getAll()
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
           $result = Client::getAll();

           //Assert
           $this->assertEquals([$test_client, $test_client2], $result);
       }

       function test_deleteAll()
       {
         //Arrange
         $name = "Bill";
         $id = null;
         $test_stylist = new Stylist($name, $id);


         $name = "Goff Uckyrself";
         $age = 10;
         $hairstyle = "short";
         $stylist_id = $test_stylist->getId();
         $test_client = new Client($id, $name, $age, $hairstyle, $stylist_id);


         $name2 = "Jim James";
         $age2 = 30;
         $hairstyle2 = "long and curly";
         $stylist_id2 = $test_stylist->getId();
         $test_client2 = new Client($id, $name2, $age2, $hairstyle2, $stylist_id2);


         //Act
         Client::deleteAll();
         $result = Client::getAll();

         //Assert
         $this->assertEquals([], $result);
       }

       function test_find()
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
             $result = Client::find($test_client->getId());

             //Assert
             $this->assertEquals($test_client, $result);
      }

      function testUpdateClient()
        {
            //Arrange
            $name = 'Sara';
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $name2 = "Javiers";
            $age = 10;
            $hairstyle = "short";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($id = null, $name2, $age, $hairstyle, $stylist_id);
            $test_client->save();

            $new_name = "Phil";
            $new_age = 40;
            $new_hairstyle = "dreds";


            //Act
            $test_client->updateClient($new_name, $new_age, $new_hairstyle);
            // $result = Restaurant::getAll();

            //Assert
            $this->assertEquals(["Phil", 40, "dreds"], [$test_client->getName(), $test_client->getAge(), $test_client->getHairstyle()]);
        }

        function testDeleteClients()
        {
            //Arrange
            $name = "John";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name = "Bill";
            $age = 0;
            $hairstyle = "short";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($id = null, $name, $age, $hairstyle, $stylist_id);
            $test_client->save();


            //Act
            $test_client->delete();

            //Assert
            $this->assertEquals([], Client::getAll());
        }

        function testDeleteOneClient()
        {
            //Arrange
            $name = "John";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name1 = "Bill";
            $age1 = 20;
            $hairstyle1 = "short";
            $stylist_id1 = $test_stylist->getId();
            $test_client1 = new Client($id = null, $name1, $age1, $hairstyle1, $stylist_id1);
            $test_client1->save();

            $name2 = "steve";
            $age2 = 10;
            $hairstyle2 = "long";
            $stylist_id2 = $test_stylist->getId();
            $test_client2 = new Client($id = null, $name2, $age2, $hairstyle2, $stylist_id2);
            $test_client2->save();

            //Act
            $test_client1->deleteOneClient();
            //Assert
            $this->assertEquals([$test_client2], Client::getAll());
        }

    }
?>
