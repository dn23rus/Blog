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
    $table = $installer->getConnection()
        ->newTable($installer->getTable('oggetto_blog/post_index'))
        ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
            'primary'  => true,
            'unsigned' => true,
            'nullable' => false,
        ), 'Entity Id')
        ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
            'primary'  => true,
            'unsigned' => true,
            'nullable' => false,
        ), 'Store Id')
        ->addColumn('url_key', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
            'nullable' => false,
        ), 'Url Key')
        ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
            'nullable' => false,
        ), 'Title')
        ->addColumn('short_description', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(), 'Short Description')
        ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
            'nullable' => false,
        ), 'Content')
        ->addColumn('author', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(), 'Author')
        ->addColumn('meta_keywords', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(), 'Meta Keywords')
        ->addColumn('meta_description', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(), 'Meta Description')
        ->addColumn('category_ids', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(), 'Meta Description')

        ->addIndex(
            $installer->getIdxName(
                $installer->getTable('oggetto_blog/post_index'),
                array('entity_id'), Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
            ), array('entity_id'), array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE)
        )
        ->addIndex(
            $installer->getIdxName($installer->getTable('oggetto_blog/post_index'), array('url_key')), array('url_key'))

        ->addForeignKey($installer->getFkName('oggetto_blog/post_index', 'entity_id', 'oggetto_blog/post', 'entity_id'),
            'entity_id', $installer->getTable('oggetto_blog/post'), 'entity_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
        )
        ->addForeignKey($installer->getFkName('oggetto_blog/post_index', 'store_id', 'core/store', 'store_id'),
            'store_id', $installer->getTable('core/store'), 'store_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
        );

    $installer->getConnection()->createTable($table);
    $connection->commit();
} catch(Exception $e) {
    Mage::logException($e);
    $connection->rollBack();
}

$installer->endSetup();