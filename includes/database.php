<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "16011164_portal");

class MySQLDB{

  function MySQLDB(){
      $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME) or die(mysqli_connect_error());
      //mysql_select_db(DB_NAME, $this->connection) or die(mysql_error());
   }
};
$database = new MySQLDB;
?>