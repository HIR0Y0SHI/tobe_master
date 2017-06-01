<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],
        

        // View settings
         'view' => [
            'template_path' =>  __DIR__ . '/../templates/',
            'twig' => [
                'cache' =>  __DIR__ . '/../cache/',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],


        // DataBase(MySQL) settings
        'db' => [
            'host' => 'localhost',
            'port' => '3306',
            'user' => 'tobe',
            'pass' => 'tobe',
            'dbname' => 'tobe_master',
        ],
    ],
];
