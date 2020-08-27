<?php
require('./config/db.php');
class DB
{
    private $link;
    function __construct()
    {
        global $host, $pass, $db, $user;
        $this->link = mysqli_connect($host, $user, $pass, $db);
        #exit($this->link);
    }
    private function DB_Escape($value)
    {
        return mysqli_escape_string($this->link, $value);
    }
    function login($email, $pass)
    {
        $query = mysqli_query($this->link, sprintf("select id,phone from users where email='%s' and password='%s' and status='ACTIVE'", $this->DB_Escape($email), $this->DB_Escape($pass)));
        $row = mysqli_fetch_assoc($query);
        return $row;
    }

    function createAlbum($name)
    {
        mysqli_query($this->link, sprintf("insert into albums (name) values('%s')", $this->DB_Escape($name)));

        return mysqli_insert_id($this->link);
    }

    function getAlbums(){
        $records=[];
        $query = mysqli_query($this->link, "select * from albums");

        while($row = mysqli_fetch_assoc($query))
        $records[]=$row;
        
        return $records;
    }

  
}
