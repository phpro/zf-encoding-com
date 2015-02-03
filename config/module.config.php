<?php

return [

    'services' => [
        'factories' => [
            'Phpro\EncodingCom\Client' => 'Phpro\EncodingCom\Factory\ClientFactory',
            'Phpro\EncodingCom\Options\EncodingCom' => 'Phpro\EncodingCom\Factory\EncodingComOptionsFactory',
        ],
    ],

    'controllers' => [
        'factories' => [
            'Phpro\EncodingCom\Controller\Notify' => 'Phpro\EncodingCom\Factory\NotifyControllerFactory',
        ],
    ],

    'router' => [
        'routes' => [
            'encodingcom' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/encodingcom',
                    'constraints' => [],
                    'defaults' => [],
                ],
                'may_terminate' => false,
                'child_routes' => [
                    'notify' => [
                        'type' => 'Zend\Mvc\Router\Http\Segment',
                        'options' => [
                            'route' => '/notify[/:hash]',
                            'constraints' => [
                                'hash' => '[0-9a-zA-Z]*',
                            ],
                            'defaults' => [
                                'controller' => 'Phpro\EncodingCom\Controller\Notify',
                                'action' => 'notify',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'phpro_encoding_com' => [

    ],

];