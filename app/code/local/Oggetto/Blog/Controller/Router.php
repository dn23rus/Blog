<?php

/**
 * Oggetto Blog extension for Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade
 * the Oggetto Blog module to newer versions in the future.
 * If you wish to customize the Oggetto Blog module for your needs
 * please refer to http://www.magentocommerce.com for more information.
 *
 * @category   Oggetto
 * @package    Oggetto_Blog
 * @copyright  Copyright (C) 2012 Oggetto Web (http://oggettoweb.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Router
 *
 * @category   Oggetto
 * @package    Oggetto_Blog
 * @subpackage Controller
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_Blog_Controller_Router extends Mage_Core_Controller_Varien_Router_Standard
{

    const URL_SUFFIX            = '.html';
    const DEFAULT_CONTROLLER    = 'index';
    const DEFAULT_ACTION        = 'view';

    /**
     * Match the request
     *
     * @param Zend_Controller_Request_Http $request request object
     * @return bool
     */
    public function match(Zend_Controller_Request_Http $request)
    {
        if (!Mage::isInstalled()) {
            Mage::app()->getFrontController()
                ->getResponse()
                ->setRedirect(Mage::getUrl('install'))
                ->sendResponse();
            exit;
        }

        $pathInfo = explode(trim($request->getPathInfo(), '/'));

        if (empty($pathInfo[0]) || $pathInfo[0] != 'blog') {
            return false;
        }

        $pathInfo[1] = !empty($pathInfo[1]) ? $pathInfo[1] : 'list';

        if (strpos($pathInfo[1], self::URL_SUFFIX) !== false) {
            $urlKey      = substr_replace($pathInfo[1], '', -1 * strlen(self::URL_SUFFIX));
            $pathInfo[1] = self::DEFAULT_ACTION;
        }

        $module     = 'oggetto_blog';
        $realModule = 'Oggetto_Blog';
        $controller = self::DEFAULT_CONTROLLER;
        $action     = $pathInfo[1];

        $controllerClassName = $this->_validateControllerClassName($realModule, $controller);
        if (!$controllerClassName) {
            return false;
        }
        $controllerInstance = Mage::getControllerInstance(
            $controllerClassName,
            $request,
            $this->getFront()->getResponse()
        );
        if (!$controllerInstance->hasAction($action)) {
            return false;
        }

        $request->setModuleName($module);
        $request->setControllerModule($realModule);
        $request->setControllerName($controller);
        $request->setActionName($action);
        $request->setParam('url_key', $urlKey);

        $request->setDispatched(true);
        $controllerInstance->dispatch($action);

        return true;
    }

    /**
     * Intit router
     *
     * @return void
     */
    public function initControllerRouters($observer)
    {
        $front = $observer->getEvent()->getFront();
        $front->addRouter('blog', $this);
    }

}
