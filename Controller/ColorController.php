<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 17.1.2019 г.
 * Time: 22:21
 */

namespace Controller;


use Service\ColorService;
use View\ViewMaker;

class ColorController
{
    const RESULTED_COLOR_MSG_TEXT = 'Търсеният от вас цвят е :';

    public function decideWhichColor()
    {
        $result = [];

        if (! empty($_POST['colorSelector'])) {
            $color = $this->hexToRGB($_POST['head']);
            if ($this->checkIfColorIsWhiteOrBlack($color)) {
                $params = [
                    'colorSelected' => $_POST['colorSelector'],
                    'color' => $color
                ];

                /** @var ColorService $colorService */
                $colorService = new ColorService();
                $result['success'] = ColorController::RESULTED_COLOR_MSG_TEXT . ' ';
                $result['success'] .= $colorService->chooseColor($params);

            } else {
                $result['success'] = 'Изберете цвят различен от бял и черен.';
            }
        } else {
            $result['success'] = 'Изберете сравнителни цветове.';
        }

        ViewMaker::ViewMake('main', $result);
    }

    public function hexToRGB($hex)
    {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }

    public function checkIfColorIsWhiteOrBlack($color)
    {
        $sum = 0;
        $result = true;

        foreach ($color as $value) {
            $sum += $value;
        }

        if ($sum == 0 || $sum == 765) {
            $result = false;
        }

        return $result;
    }
}