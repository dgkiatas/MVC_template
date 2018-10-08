<?php
class Config
{
    static $use_database = True;
    static $maintenance = False;
    static $db_config = array (
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'database_name',
        'user' => 'db_user',
        'pwd' => 'db_user_password',

    );
}