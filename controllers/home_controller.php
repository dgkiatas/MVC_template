<?php

class HomeController
{
    
    function __construct()
    {
        $model = new Home();
    }
    public function home()
    {
        render();
    }
    public function error()
    {
        render();
    }

}
