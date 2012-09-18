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
 * Category tab form
 *
 * @category   Oggetto
 * @package    Oggetto_Blog
 * @subpackage Block
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_Blog_Block_Adminhtml_Blog_Edit_Tab_Category
    extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Categories
{

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('oggetto_blog/categories.phtml');
    }

    /**
     * Retrieves post object
     *
     * @return \Oggetto_Blog_Model_Post
     */
    public function getPost()
    {
        return Mage::registry('current_oggetto_blog_post');
    }

    /**
     * Retrieves post category ids
     *
     * @return array
     */
    public function getCategoryIds()
    {
        if ($this->getPost() && $this->getPost()->getId()) {
            return $this->getPost()->getCategoryIds();
        }
        return array();
    }

    /**
     * Get ids string
     *
     * @return string
     */
    public function getIdsString()
    {
        return '';
    }

    /**
     * Checks when this block is readonly
     *
     * @return boolean
     */
    public function isReadonly()
    {
        return false;
    }
}