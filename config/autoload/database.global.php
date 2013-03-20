<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'db' => array(
        'driver'    => 'pdo',
        'dsn'       => 'mysql:dbname=pacman;host=localhost',
        'username'  => 'pacman',
        'password'  => '1234',
    ),
);
