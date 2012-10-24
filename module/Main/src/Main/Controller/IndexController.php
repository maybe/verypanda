<?php
/**
 * IndexCongtroller
 * @copyright Copyright (c) 2010-2012 BadPanda Inc.
 */


namespace Main\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();   
    }
}
