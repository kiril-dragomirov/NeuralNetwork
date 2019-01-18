<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 17.1.2019 г.
 * Time: 22:00
 */
namespace Controller;

use View\ViewMaker;

class BaseController
{
    public function getMainPage()
    {
        return ViewMaker::ViewMake('main');
    }
}