<?php
namespace SON\Di;
use App\Init;

class Container
{
    public static function getClass($name) 
     {
        $str_class="\\App\\Models\\".ucfirst($name);
        $class = new $str_class (\App\Init::getDB());
        return  $class;
        
    }
}
