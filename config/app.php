<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 21.09.2020
 * Time: 16:05
 */

return [

    /*general configuration*/
    'general' =>[
        'path' => __DIR__,
    ],
    /*Config of RAD rapid app development tool*/
    'rad' => [
        /* Joomla component templates*/
        'templates' => [
            'default' => 'HelloWorld',
            'path' => 'storage\templates',
        ],

        /* directory for editing components*/
        'workplace' => [
            'path' => 'storage\workplace',
            'cleanExec'=> '',
        ],

        /* directory for final zipped components*/
        'publish' => [
            'path' => 'storage\publish',
            /*i.e. "C:\Program Files\PuTTY\putty.exe" or bash file*/
            'exec' => '',
        ]
    ],
];