+<?php
 +    class Client
 +    {
 +        private $id;
 +        private $name;
 +        private $age;
 +        private $hairstyle;
 +        private $stylist_id;
 +
 +        function __construct($id = null, $name, $age, $hairstyle, $stylist_id)
 +        {
 +            $this->id = $id;
 +            $this->name = $name;
 +            $this->age = $age;
 +            $this->hairstyle = $hairstyle;
 +            $this->stylist_id = $stylist_id;
 +        }
 +
 +        function getId()
 +        {
 +            return $this->id;
 +        }
 +
 +        function setName($new_name)
 +        {
 +            $this->name = (string) $new_name;
 +        }
 +
 +        function getName()
 +        {
 +            return $this->name;
 +        }
 +
 +        function setAge($new_age)
 +        {
 +            $this->age = $new_age;
 +        }
 +
 +        function getAge()
 +        {
 +            return $this->happy_hour;
 +        }
 +
 +        function setHairstyle($new_hairstyle)
 +        {
 +            $this->hairstyle = (string) $new_hairstyle;
 +        }
 +
 +        function getHairstyle()
 +        {
 +            return $this->hairstyle;
 +        }
 +
 +        function getStylistId()
 +        {
 +            return $this->stylist_id;
 +        }
 +    }
 +?>
