<?php
namespace SON\Di;
use App\Init;

class Container
{
    public static function getClass($name) 
     {
        $str_class="\\App\\Models\\".ucfirst($name);
        $class = new $str_class ();
        return  $class;
    }
    
    public static function getDao($name)
    {
        $str_class="\\SON\\Dao\\".ucfirst($name);
        $class = new $str_class (Init::getDB());
        return $class;
    }
}
