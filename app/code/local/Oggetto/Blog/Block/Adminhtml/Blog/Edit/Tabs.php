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
 * Tabs
 *
 * @category   Oggetto
 * @package    Oggetto_Blog
 * @subpackage Block
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_Blog_Block_Adminhtml_Blog_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('oggetto_blog_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('oggetto_blog')->__('Post Information'));
    }

    /**
     * Before rendering html, but after trying to load cache
     *
     * @return \Mage_Core_Block_Abstract
     */
    protected function _beforeToHtml()
    {
        $this->addTab('general_section', array(
            'label'     => Mage::helper('oggetto_blog')->__('Genaral'),
            'title'     => Mage::helper('oggetto_blog')->__('General'),
            'content'   => $this->getLayout()->createBlock('oggetto_blog/adminhtml_blog_edit_tab_general')->toHtml(),
        ));

        $this->addTab('advanced_section', array(
            'label'     => Mage::helper('oggetto_blog')->__('Advanced'),
            'title'     => Mage::helper('oggetto_blog')->__('Advanced'),
            'content'   => $this->getLayout()->createBlock('oggetto_blog/adminhtml_blog_edit_tab_advanced')->toHtml(),
        ));

        $this->addTab('category_section', array(
            'label'     => Mage::helper('oggetto_blog')->__('Category'),
            'title'     => Mage::helper('oggetto_blog')->__('Category'),
            'content'   => $this->getLayout()->createBlock('oggetto_blog/adminhtml_blog_edit_tab_category')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}