<?php
class Mysql
{
    public static $connection;
    function connect()
    {
        $host = Config::$mysql['host'];
        $port = Config::$mysql['port'];
        $db = Config::$mysql['database'];
        $user = Config::$mysql['user'];
        $pwd = Config::$mysql['pwd'];
        
        try
		{
			Mysql::$connection = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$db, $user, $pwd);
		} 
		catch (PDOException $e)
		{
			die("Error: ".$e->getMessage());
		}	
    }

    function disconnectDB()
	{
		Mysql::$connection = null;
	}
    function select($table,$params='')
    {
        $query=Mysql::$connection -> prepare("select * from $table $params;");
        $query->execute();
		return $query->fetchAll();
		
    }

}