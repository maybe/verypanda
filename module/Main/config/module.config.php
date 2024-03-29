<?php
/**
 * Main Module Config
 * @copyright Copyright (c) 2010-2012 BadPanda Inc.
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/[:lang/]',   
                    'constraints' => array(
                        'lang' => '[a-z]{2}',
                    ),                    
                    'defaults' => array(
                        '__NAMESPACE__' => 'Main\Controller',
                        'controller' => 'Main\Controller\Index',
                        'action'     => 'index',
                        'lang' => 'en',
                    ),                  
                ),
                'may_terminate' => true,
                'child_routes' => array( 
                    //controller and action
                    'controller_action' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[:controller][/:action][/]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Main\Controller',
                            )
                        )
                    ),          
                    //controller
                    'controller' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[:controller][/]',
                            'defaults' => array(
                                'action'  =>  'index',
                            )
                        )
                    ), 
                ),
            ),
            'lang' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/[:lang]',   
                    'constraints' => array(
                        'lang' => '[a-z]{2}',
                    ),                    
                    'defaults' => array(
                        '__NAMESPACE__' => 'Main\Controller',
                        'controller' => 'Main\Controller\Index',
                        'action'     => 'index',
                        'lang' => 'en',
                    ),                  
                ),
            ),             
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Main\Controller\Index' => 'Main\Controller\IndexController',
            'Main\Controller\Activity' => 'Main\Controller\ActivityController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'main/index/index' => __DIR__ . '/../view/main/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
