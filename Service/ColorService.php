<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 17.1.2019 г.
 * Time: 22:43
 */

namespace Service;

class ColorService
{
    const RB = 1;
    const RG = 2;
    const GB = 3;

    const ARRAY_WITH_COLOR_TYPES = [
        ColorService::RB => 'redBlue.ini',
        ColorService::RG => 'redGreen.ini',
        ColorService::GB => 'greenBlue.ini'
    ];

    const ARRAY_WITH_RESULT_COLORS = [
        ColorService::RB => [
            0 => 'red',
            1 => 'blue'
        ],
        ColorService::RG => [
            0 => 'green',
            1 => 'red'
        ],
        ColorService::GB => [
            0 => 'green',
            1 => 'blue'
        ]
    ];


    public function chooseColor($params)
    {
        $colorIni = ColorService::ARRAY_WITH_COLOR_TYPES[$params['colorSelected']];
        $nuralNetwor = new \NeuralNetwork(4, 4, 1);
        $nuralNetwor->setVerbose(false);
        $nuralNetwor->load("$colorIni"); // load the saved weights into the initialized neural network. This way you won't need to train the network each time the application has been executed

        $input = array($this->normalize($params['color'][0]), $this->normalize($params['color'][1]), $this->normalize($params['color'][2]));  //note that you will have to write a normalize function, depending on your needs
        $result = $nuralNetwor->calculate($input);

        if ($result[0] > 0.5) {
            $searchedColor = ColorService::ARRAY_WITH_RESULT_COLORS[$params['colorSelected']][1];
        } else {
            $searchedColor = ColorService::ARRAY_WITH_RESULT_COLORS[$params['colorSelected']][0];
        }

        return $searchedColor;
    }

    public function normalize($n)
    {
        return $n * (1 / 255) + (-1);
    }
}