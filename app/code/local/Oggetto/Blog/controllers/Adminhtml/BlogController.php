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
 * Blog contoller
 *
 * @category   Oggetto
 * @package    Oggetto_Blog
 * @subpackage controllers
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_Blog_Adminhtml_BlogController extends Mage_Adminhtml_Controller_Action
{

    /**
     * Index action
     *
     * @return void
     */
    public function indexAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('oggetto_blog/post')
            ->_addBreadcrumb(
                Mage::helper('oggetto_blog')->__('Blog Manager'),
                Mage::helper('oggetto_blog')->__('Blog Manager'));
        $this->renderLayout();
    }

    /**
     * New action
     *
     * @return void
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Edit action
     *
     * @return void
     */
    public function editAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('oggetto_blog/new_post')
            ->_addBreadcrumb(
                Mage::helper('oggetto_blog')->__('Blog Manager'),
                Mage::helper('oggetto_blog')->__('Blog Manager'));


        if ($id = $this->getRequest()->getParam('id')) {
            Mage::register(Oggetto_Blog_Model_Post::REGISTRY_KEY, Mage::getModel('oggetto_blog/post')->load($id));
        }

        $this->renderLayout();
    }

    /**
     * SavePost action
     *
     * @return void
     */
    public function savePostAction()
    {
        if (!$this->getRequest()->isPost()) {
            return;
        }

        $id        = $this->getRequest()->getParam('id');
        $data      = $this->getRequest()->getPost();
        $postModel = Mage::getModel('oggetto_blog/post');

        try {
            $date = now();
            if ($id > 0) {
                $postModel->load($id);
            } else {
                $postModel->setCreatedAt($date);
            }

            $postModel->setUpdatedAt($date);
            $postModel->addData($data);

            if (empty($data['url_key'])) {
                $postModel->setUrlKey($postModel->generateUrlKey());
            }

            $postModel->validate()->save();

            Mage::getSingleton('adminhtml/session')
                ->addSuccess(Mage::helper('oggetto_blog')->__('Post was successfully saved.'));

            return $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('oggetto_blog')->__('Something went wrong while saving post.'));
        }
        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
    }

    /**
     * Categories json action
     *
     * @return void
     */
    public function categoriesJsonAction()
    {
        if (!Mage::registry(Oggetto_Blog_Model_Post::REGISTRY_KEY)) {
            Mage::register(Oggetto_Blog_Model_Post::REGISTRY_KEY, 
                Mage::getModel('oggetto_blog/post')->load($this->getRequest()->getParam('id')));
        }

        $this->getResponse()->setBody($this->getLayout()->createBlock('oggetto_blog/adminhtml_blog_edit_tab_category')
                ->getCategoryChildrenJson($this->getRequest()->getParam('category')));
    }
}