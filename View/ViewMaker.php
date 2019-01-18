<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 17.1.2019 г.
 * Time: 22:00
 */

namespace View;

class ViewMaker
{
    public static function ViewMake($namePage, $params = [])
    {
        return require_once $namePage.'.phtml';
    }
}