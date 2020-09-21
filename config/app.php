<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 21.09.2020
 * Time: 16:05
 */

return [

    'general' =>[
        'path' => __DIR__,
    ],
    /*Config of RAD rapid app development tool*/
    'rad' => [
        /* Joomla component templates*/
        'templates' => [
            'default' => 'joomlavelcnct',
            'path' => 'storage\templates',
            //'version' => 1,  //TODO:
            //'repository' => 'https://github.com/Joomlavel/templates' //TODO:
        ],

        'workplace' => [
            'path' => 'storage\workplace',
            //'version' => 1  //TODO:
        ],

        /* TODO:
        'publish' => [
            'path' => '../storage/publish',
            'version' => 1,
            'exec' => ''
        ]
        */
    ],
];