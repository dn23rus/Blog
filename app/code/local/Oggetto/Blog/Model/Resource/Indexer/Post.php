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

    protected $_bindLimit = 100;

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
     * @param array $entityIds entity id(s)
     * @return void
     */
    protected function _reindexEntity($entityIds = null)
    {
        $stores = Mage::app()->getStores();

        foreach ($stores as $store) {

            $postCollection = $this->_getPostCollection($entityIds, $store);
            $rowsCount      = 0;
            $bind           = array();

            foreach ($postCollection as $post) {
                $bind[] = $this->_getBindRow($post);
                $rowsCount ++;
                if ($rowsCount >= $this->_bindLimit) {
                    $this->_getWriteAdapter()->insertMultiple($this->getMainTable(), $bind);
                    $rowsCount = 0;
                    $bind = array();
                }
            }
        }
    }

    /**
     * Post bind
     *
     * @param Oggetto_Blog_Mode_Post $post post model
     * @return void
     */
    protected function _getBindRow(Oggetto_Blog_Mode_Post $post)
    {
        return array(
            'entity_id'         => (int) $post->getId(),
            'store_id'          => (int) $post->getStoreId(),
            'url_key'           => $post->getUrlKey(),
            'title'             => $post->getTitle(),
            'short_description' => $post->getShortDescription(),
            'content'           => $post->getContent(),
            'author'            => $post->getAuthor(),
            'meta_keywords'     => $post->getMetaKeywords(),
            'meta_description'  => $post->getMetaDescription(),
            'category_ids'      => $post->getCategoryIds(),
        );
    }

    /**
     * Posts colleciton
     *
     * @param array                 $entityIds entity id(s)
     * @param Mage_Core_Model_Store $store     store
     * @return Oggetto_Blog_Model_Resource_Post_Collection
     */
    protected function _getPostCollection($entityIds, $store)
    {
        $postCollection = Mage::getModel('oggetto_blog/post')->getCollection();
        $postCollection->addAttributeToSelect('title');
        $postCollection->addAttributeToSelect('short_description');
        $postCollection->addAttributeToSelect('content');
        $postCollection->addAttributeToSelect('author');
        $postCollection->addAttributeToSelect('meta_keywords');
        $postCollection->addAttributeToSelect('meta_description');
        $postCollection->addAttributeToSelect('category_ids');
        if (!empty($entityId)) {
            $postCollection->addFieldToFilter('entity_id', array('in' => $entityId));
        }
        $postCollection->addStoreFilter($store);

        return $postCollection;
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