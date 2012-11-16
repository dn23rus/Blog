<?php

/**
 * Oggetto Post extension for Magento
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
 * the Oggetto Post module to newer versions in the future.
 * If you wish to customize the Oggetto Post module for your needs
 * please refer to http://www.magentocommerce.com for more information.
 *
 * @category   Oggetto
 * @package    Oggetto_Post
 * @copyright  Copyright (C) 2012 Oggetto Web (http://oggettoweb.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Post resource
 *
 * @category   Oggetto
 * @package    Oggetto_Post
 * @subpackage Model
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_Blog_Model_Resource_Post extends Mage_Eav_Model_Entity_Abstract
{

    /**
     * Resource initiallization
     *
     * @return void
     */
    protected function _construct()
    {
        $resource = Mage::getSingleton('core/resource');
        $this->setType(Oggetto_Blog_Model_Post::ENTITY);
        $this->setConnection(
            $resource->getConnection('oggetto_blog_read'),
            $resource->getConnection('oggetto_blog_write')
        );
    }

    /**
     * Retrieve default entity attributes
     *
     * @return array
     */
    protected function _getDefaultAttributes()
    {
        return array(
            'entity_id',
            'entity_type_id',
            'store_id',
            'url_key',
            'created_at',
            'updated_at',
            'is_active',
        );
    }
}