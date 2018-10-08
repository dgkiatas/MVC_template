<?php
//Start session
session_start();
//Load configuration file
require_once('config.php');
//Load application's classes 
$app_classes = glob('apps/*.php');
foreach ($app_classes as $file)
{
    require_once $file;
}
$_SESSION['user_id']="test";
/* 
    Database enabled app flag $use_database=true|false in config.php.
    If flag is true check connection with database.
*/
if (Config::$maintenance)
{
    $controller = $action = "maintenance";
    echo $controller.' '.$action;
}
else
{
    if (Config::$use_database)
    {
        //Check if user is logged in (user_id)
        if (isset($_SESSION['user_id']))
        {
            
            if (isset($_GET['request']))
            {
                //url handling
                $request = explode('/', $_GET['request']);
                
                $controller = $request[0];
                if(strcmp($controller, 'maintenance') == 0 )
                {
                    header('Location: /');
                }
                elseif(strcmp($controller, 'login') == 0 )
                {
                    header('Location: /');
                }
                if( count($request) > 1 )
                {
                    $action = $request[1];
                    /*
                        add more variables if url has more than two get variables p.e. http://test.com/home/action/id
                        $id = $request[2];

                    */

                }
                else
                {
                    $action = $controller;
                }
            }
            else
            {
                //default url
                $controller = "home";
                $action = "home";
            }
        }
        else
        {
            if( isset($_POST['username']) && isset($_POST['password']) )
            {
                $controller = 'login';
                $action = 'submit';

            }
            else
            {
                $controller = 'login';
                $action = 'login';
            }
        }
    }
    else
    {
        if (isset($_GET['request']))
        {
            //url handling
            $request = explode('/', $_GET['request']);
            
            $controller = $request[0];
            if(strcmp($controller, 'maintenance') == 0 )
            {
                header('Location: /');
            }
            elseif(strcmp($controller, 'login') == 0 )
            {
                header('Location: /');
            }
            if( count($request) > 1 )
            {
                /*
                        add more variables if url has more than two get variables p.e. http://test.com/home/action/id
                        $id = $request[2];

                    */

                $action = $request[1];
            }
            else
            {
                $action = $controller;
            }
        }
        else
        {
                //default url
                $controller = "home";
                $action = "home";
        }
    }
}

require_once('routes.php');
