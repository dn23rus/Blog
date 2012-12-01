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
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */

$installer  = $this; /* @var $installer Oggetto_Blog_Model_Resource_Setup */
$connection = $installer->getConnection();

$installer->startSetup();

try {
    $connection->beginTransaction();
    $installer->addEntityType(Oggetto_Blog_Model_Post::ENTITY, array(
        'entity_model'  => 'oggetto_blog/post',
        'table'         => 'oggetto_blog/post',
    ));
    $installer->createEntityTables($this->getTable('oggetto_blog/post'));
    $installer->installEntities();
    $connection->commit();
} catch (Exception $e) {
    Mage::logException($e);
    $connection->rollBack();
}

$installer->endSetup();
