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
 * Post Indexer resource
 *
 * @category   Oggetto
 * @package    Oggetto_Blog
 * @subpackage Model
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_Blog_Model_Resource_Indexer_Post extends Mage_Index_Model_Resource_Abstract
{

    /**
     * Resouce initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_setResource('oggetto_blog');
    }

    /**
     * Reindex entities
     *
     * @param array $entityId entity id(s)
     * @return void
     */
    protected function _reindexEntity($entityId = null)
    {

    }

    /**
     * Reindex all
     *
     * @return void
     */
    public function reindexAll()
    {
        $this->_reindexEntity();
    }

    /**
     * Handler for save event on particular post
     *
     * @param Mage_Index_Model_Event $event event
     * @return void
     */
    public function oggettoBlogPostSave($event)
    {
        $this->_reindexEntity($event->getData('entity_id'));
    }

    /**
     * Handler for updating posts data via massaction
     *
     * @param Mage_Index_Model_Event $event event
     * @return void
     */
    public function oggettoBlogPostMassAction($event)
    {
        $this->_reindexEntity($event->getData('entity_ids'));
    }
}