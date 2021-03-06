<?php
     class Client
     {
         private $id;
         private $name;
         private $age;
         private $hairstyle;
         private $stylist_id;

         function __construct($id = null, $name, $age, $hairstyle, $stylist_id)
         {
             $this->id = $id;
             $this->name = $name;
             $this->age = $age;
             $this->hairstyle = $hairstyle;
             $this->stylist_id = $stylist_id;
         }

         function getId()
         {
             return $this->id;
         }

         function setName($new_name)
         {
             $this->name = (string) $new_name;
         }

         function getName()
         {
             return $this->name;
         }

         function setAge($new_age)
         {
             $this->age = $new_age;
         }

         function getAge()
         {
             return $this->age;
         }

         function setHairstyle($new_hairstyle)
         {
             $this->hairstyle = (string) $new_hairstyle;
         }

         function getHairstyle()
         {
             return $this->hairstyle;
         }

         function getStylistId()
         {
             return $this->stylist_id;
         }

				 function save()
	        {
	            $GLOBALS['DB']->exec("INSERT INTO clients (name, age, hairstyle, stylist_id) VALUES ('{$this->getName()}', {$this->getAge()}, '{$this->getHairstyle()}', {$this->getStylistId()});");
	            $this->id = $GLOBALS['DB']->lastInsertId();
	        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM  clients;");
            $clients = array();
            foreach($returned_clients as $client) {
                $name = $client['name'];
                $age = $client['age'];
                $id = $client['id'];
                $stylist_id = $client['stylist_id'];
                $hairstyle = $client['hairstyle'];
                $new_client = new Client($id, $name, $age, $hairstyle, $stylist_id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

        static function find($search_id)
        {
            $found_client = null;
            $clients = Client::getAll();
            foreach($clients as $client) {
                $client_id = $client->getId();
                if ($client_id == $search_id) {
                  $found_client = $client;
                }
            }
            return $found_client;
        }

        function updateClient($new_name, $new_age, $new_hairstyle)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}', age = {$new_age}, hairstyle = '{$new_hairstyle}' WHERE id = {$this->getId()};");

            $this->setName($new_name);
            $this->setAge($new_age);
            $this->setHairstyle($new_hairstyle);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getStylistId()};");
        }

        function deleteOneClient()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
        }


    }
 ?>
