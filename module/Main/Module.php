<?php
/**
 * Main Module
 * @copyright Copyright (c) 2010-2012 BadPanda Inc.
 */

namespace Main;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $eventManager->attach(\Zend\Mvc\MvcEvent::EVENT_DISPATCH, array($this, 'preDispatch'), 100);
    }
    
    public function preDispatch($e)
    {
        $matches      = $e->getRouteMatch();
        $controller   = $matches->getParam('controller');
        $action       = $matches->getParam('action', 'index');
        $lang         = $matches->getParam('lang');

        $trans = "en_US";
        if ($lang == "cn")
          $trans = "zh_CN";
        
        $translator = $e->getApplication()->getServiceManager()->get('translator');
        $translator
          ->setLocale($trans)
          ->setFallbackLocale('en_US'); 
        // return a 401 response
        // or a redirect response (e.g., to a login page)
    } 
    

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
