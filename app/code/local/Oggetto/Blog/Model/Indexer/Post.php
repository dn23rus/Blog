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
 * Post Indexer
 *
 * @category   Oggetto
 * @package    Oggetto_Blog
 * @subpackage Model
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_Blog_Model_Indexer_Post extends Mage_Index_Model_Indexer_Abstract
{

    protected $_matchedEntities = array(
        Oggetto_Blog_Model_Post::ENTITY => array(
            Mage_Index_Model_Event::TYPE_SAVE,
            Mage_Index_Model_Event::TYPE_MASS_ACTION
        ),
    );

    /**
     * Init resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('oggetto_blog/indexer_post');
    }

    /**
     * Retreive indexer name
     *
     * @return string
     */
    public function getName()
    {
        return Mage::helper('oggetto_blog')->__('Blog Posts Flat Data');
    }

    /**
     * Retreive indexer description
     *
     * @return string
     */
    public function getDescription()
    {
        return Mage::helper('oggetto_blog')->__('Reorganize EAV blog structure to flat structure');
    }

    /**
     * Registering new event
     *
     * @param Mage_Index_Model_Event $event New event
     * @return void
     */
    protected function _registerEvent(Mage_Index_Model_Event $event)
    {
        $entity = $event->getDataObject();
        if ($entity->hasDataChanges()) {
            $event->setData('entity_id', $entity->getId());
        }
    }

    /**
     * Processing new event
     *
     * @param Mage_Index_Model_Event $event New event
     * @return void
     */
    protected function _processEvent(Mage_Index_Model_Event $event)
    {
        if ($event->getData('entity_id')) {
            $this->callEventHandler($event);
        }
    }
}