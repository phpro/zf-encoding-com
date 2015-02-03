<?php

return [

    'service_manager' => [
        'factories' => [
            'Phpro\EncodingCom\Client' => 'Phpro\EncodingCom\Factory\ClientFactory',
            'Phpro\EncodingCom\Options\EncodingCom' => 'Phpro\EncodingCom\Factory\EncodingComOptionsFactory',
            'Phpro\EncodingCom\Service\RouteAssembler' => 'Phpro\EncodingCom\Factory\RouteAssemblerFactory',
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
        'api' => [
            'user_id' => '',
            'user_key' => '',
        ],
        'notify' => [
            'format' => 'xml',
            'notify_route' => 'encodingcom/notify',
            'notify_service' => '',
        ],
        'local_tunnel' => [
            'enabled' => false,
            'host' => '',
        ],
        'hash' => '',
    ],

];