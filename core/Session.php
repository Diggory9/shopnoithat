<?php


namespace app\core;
class Session
{

    protected const FLASH_KEY = 'flash_message';

    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION['flash_message']??[];
        foreach($flashMessages as $key => &$value)
        {
            // mark to be remove

            $value['remove'] = true;

        }
        $_SESSION['flash_message'] = $flashMessages;
    }

    public function setFlash($key , $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' =>false,
            'value' => $message
        ]; 
    }
    public function removeFlash($key)
    {
        $flashMessages = $_SESSION['flash_message']??[];
        if(!empty($flashMessages[$key]))
        {
            unset($flashMessages[$key]);
        }
        $_SESSION['flash_message'] = $flashMessages;
    }
    public function getFlash($key)
    {
        if(!empty($_SESSION[self::FLASH_KEY][$key]))
        { 
            return  $_SESSION[self::FLASH_KEY][$key]['value']; 
        }
        return false;
    }


    public function set($key, $message)
    {
        $_SESSION[$key] = $message;
    }

    public function get($key)
    {
        if(!empty($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }
        return false;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public function __destruct()
    {
        $flashMessages = $_SESSION['flash_message']??[];
        foreach($flashMessages as $key => &$value)
        {
           
            if( $value['remove'])
            {
                unset($value[$key]);
            }
        }
        $_SESSION['flash_message'] = $flashMessages;
        
    }
}