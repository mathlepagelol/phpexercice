<?php

class post{
    
    public static function get($element)
    {
        return $_POST[$element];
    }

    public static function unset($element)
    {
        unset($_POST[$element]);
        return !$_POST[$element];
    }

    public static function array()
    {
        return $_POST;
    }

    public static function not_null($element)
    {
        if(is_array($element))
        {
            foreach($element as $el)
            {
                if(!$_POST[$el])
                    return false;
            }
        }
        else
        {
            if(!$_POST[$element])
                return false;
        }
        return true;
    }
}