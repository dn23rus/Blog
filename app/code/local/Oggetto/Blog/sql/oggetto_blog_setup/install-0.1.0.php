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
 * @copyright  Copyright (C) 2011 Oggetto Web (http://oggettoweb.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */

$installer = $this; /* @var $installer Oggetto_Blog_Model_Resource_Setup */

//throw new Exception('?!-This is an exception to stop the installer from completing');

$installer->startSetup();


$installer->addEntityType('oggetto_blog_post', array(
    'entity_model'  => 'oggetto_blog/post',
    'table'         => 'oggetto_blog/post',
));

$table = $installer->getConnection()
    ->newTable($this->getTable('oggetto_blog/post'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Entity Id')
    ->addColumn('entity_type_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
    ), 'Entity Type Id')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable'  => false,
    ), 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable'  => false,
    ), 'Updated At')
    ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '1',
    ), 'Defines Is Entity Active')
    ->addIndex($this->getIdxName($this->getTable('oggetto_blog/post'),
        array('entity_type_id')), array('entity_type_id'))
    ->addForeignKey(
        $this->getFkName($this->getTable('oggetto_blog/post'), 'entity_type_id', 'eav/entity_type', 'entity_type_id'),
        'entity_type_id', $this->getTable('eav/entity_type'), 'entity_type_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE);

$installer->getConnection()->createTable($table);

$installer->createEntityTables($this->getTable('oggetto_blog/post'), array('no-main' => true));

$installer->addAttribute('oggetto_blog_post', 'title', array(
    'type'                      => 'varchar',
    'label'                     => 'Title',
    'input'                     => 'text',
    'class'                     => '',
    'backend'                   => '',
    'frontend'                  => '',
    'source'                    => '',
    'required'                  => true,
    'user_defined'              => true,
    'default'                   => '',
    'unique'                    => false,
));

$installer->addAttribute('oggetto_blog_post', 'url_key', array(
    'type'                      => 'varchar',
    'label'                     => 'URL Key',
    'input'                     => 'text',
    'class'                     => '',
    'backend'                   => '',
    'frontend'                  => '',
    'source'                    => '',
    'required'                  => false,
    'user_defined'              => true,
    'default'                   => '',
    'unique'                    => true,
));

$installer->addAttribute('oggetto_blog_post', 'short_description', array(
    'type'                      => 'text',
    'label'                     => 'Short Description',
    'input'                     => 'textarea',
    'class'                     => '',
    'backend'                   => '',
    'frontend'                  => '',
    'source'                    => '',
    'required'                  => false,
    'user_defined'              => true,
    'default'                   => '',
    'unique'                    => false,
));

$installer->addAttribute('oggetto_blog_post', 'content', array(
    'type'                      => 'text',
    'label'                     => 'Content',
    'input'                     => 'textarea',
    'class'                     => '',
    'backend'                   => '',
    'frontend'                  => '',
    'source'                    => '',
    'required'                  => true,
    'user_defined'              => true,
    'default'                   => '',
    'unique'                    => false,
));

$installer->addAttribute('oggetto_blog_post', 'meta_keywords', array(
    'type'                      => 'text',
    'label'                     => 'Keywords',
    'input'                     => 'textarea',
    'class'                     => '',
    'backend'                   => '',
    'frontend'                  => '',
    'source'                    => '',
    'required'                  => false,
    'user_defined'              => true,
    'default'                   => '',
    'unique'                    => false,
));

$installer->addAttribute('oggetto_blog_post', 'meta_description', array(
    'type'                      => 'text',
    'label'                     => 'Description',
    'input'                     => 'textarea',
    'class'                     => '',
    'backend'                   => '',
    'frontend'                  => '',
    'source'                    => '',
    'required'                  => false,
    'user_defined'              => true,
    'default'                   => '',
    'unique'                    => false,
));

$installer->addAttribute('oggetto_blog_post', 'author', array(
    'type'                      => 'varchar',
    'label'                     => 'Author',
    'input'                     => 'text',
    'class'                     => '',
    'backend'                   => '',
    'frontend'                  => '',
    'source'                    => '',
    'required'                  => false,
    'user_defined'              => true,
    'default'                   => '',
    'unique'                    => true,
));

$installer->addAttribute('oggetto_blog_post', 'category_ids', array(
    'type'                      => 'varchar',
    'label'                     => 'Category Ids',
    'input'                     => 'text',
    'class'                     => '',
    'backend'                   => '',
    'frontend'                  => '',
    'source'                    => '',
    'required'                  => false,
    'user_defined'              => true,
    'default'                   => '',
    'unique'                    => false,
));

$installer->addAttribute(Oggetto_Blog_Model_Post::ENTITY, 'is_hidden', array(
    'type'                      => 'int',
    'label'                     => 'Show on front',
    'input'                     => 'select',
    'source'                    => 'eav/entity_attribute_source_boolean',
    'class'                     => '',
    'backend'                   => '',
    'frontend'                  => '',
    'required'                  => true,
    'user_defined'              => false,
    'default'                   => '1',
    'unique'                    => false
));

$installer->endSetup();