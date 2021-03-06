<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonPacman for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */


return array(

    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Pacman\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            
            'project' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/project[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Pacman\Controller\Project',
                        'action'     => 'list',
                    ),
                ),
            ),
            
            'category' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/category[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Pacman\Controller\Category',
                        'action'     => 'list',
                    ),
                ),
            ),

            'environment' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/environment[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Pacman\Controller\Environment',
                        'action'     => 'list',
                    ),
                ),
            ),
            
            'customer' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/customer[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Pacman\Controller\Customer',
                        'action'     => 'list',
                    ),
                ),
            ),
            
            'credential' => array(
                    'type'    => 'segment',
                    'options' => array(
                            'route'    => '/credential[/:action][/:id]',
                            'constraints' => array(
                                    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                    'controller' => 'Pacman\Controller\Credential',
                                    'action'     => 'list',
                            ),
                    ),
            ),
            
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /Pacman/:controller/:action
            'Pacman' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/Pacman',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Pacman\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
                'permission' => array (
                    'admin' => 512,
                    'alterlogin' => 256,
                    'modifyallprojects' => 128,
                    'createproject' => 64,
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
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
            'Pacman\Controller\Index' => 'Pacman\Controller\IndexController',
            'Pacman\Controller\Project' => 'Pacman\Controller\ProjectController',
            'Pacman\Controller\Category' => 'Pacman\Controller\CategoryController',
            'Pacman\Controller\Environment' => 'Pacman\Controller\EnvironmentController',
            'Pacman\Controller\Customer' => 'Pacman\Controller\CustomerController',
            'Pacman\Controller\Credential' => 'Pacman\Controller\CredentialController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(    //I guess there is a better, easier way for this...
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'pacman/index/index'      => __DIR__ . '/../view/pacman/index/index.phtml',
            'pacman/projects/index'   => __DIR__ . '/../view/pacman/projects/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
