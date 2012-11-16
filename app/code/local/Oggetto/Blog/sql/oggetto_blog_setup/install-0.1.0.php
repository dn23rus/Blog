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

$installer->startSetup();

$entity = Oggetto_Blog_Model_Post::ENTITY;

$installer->addEntityType($entity, array(
    'entity_model'  => 'oggetto_blog/post',
    'table'         => 'oggetto_blog/post',
));

$installer->createEntityTables($this->getTable('oggetto_blog/post'));

$installer->addAttribute($entity, 'title', array(
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

$installer->addAttribute($entity, 'short_description', array(
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

$installer->addAttribute($entity, 'content', array(
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

$installer->addAttribute($entity, 'meta_keywords', array(
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

$installer->addAttribute($entity, 'meta_description', array(
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

$installer->addAttribute($entity, 'author', array(
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

$installer->addAttribute($entity, 'category_ids', array(
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

$installer->endSetup();