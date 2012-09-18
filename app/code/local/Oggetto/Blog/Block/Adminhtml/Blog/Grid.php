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
 * Blog grid
 *
 * @category   Oggetto
 * @package    Oggetto_Blog
 * @subpackage Block
 * @author     Dmitry Buryak <b.dmitry@oggettoweb.com>
 */
class Oggetto_Blog_Block_Adminhtml_Blog_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('blogGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare grid collection object
     *
     * @return \Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('oggetto_blog/post')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare columns
     *
     * @return void
     */
    protected function _prepareColumns()
    {
        $this
            ->addColumn('entity_id', array(
                'header'    => Mage::helper('oggetto_blog')->__('ID'),
                'align'     => 'right',
                'index'     => 'entity_id',
                'width'     => '50px',
                'type'      => 'number'
            ))
            ->addColumn('title', array(
                'header'    => Mage::helper('oggetto_blog')->__('Title'),
                'index'     => 'title',
                'type'      => 'text',
                'escape'    => true,
            ))
            ->addColumn('short_description', array(
                'header'    => Mage::helper('oggetto_blog')->__('Short Description'),
                'index'     => 'author',
                'type'      => 'text',
                'escape'    => true,
                'string_limit' => 255,
            ))
            ->addColumn('author', array(
                'header'    => Mage::helper('oggetto_blog')->__('Author'),
                'index'     => 'author',
                'type'      => 'text',
            ))
            ->addColumn('created_at', array(
                'header'    => Mage::helper('oggetto_blog')->__('Created at'),
                'index'     => 'created_at',
                'type'      => 'datetime'
            ))
            ->addColumn('updated_at', array(
                'header'    => Mage::helper('oggetto_blog')->__('Updated at'),
                'index'     => 'updated_at',
                'type'      => 'datetime'
            ))
//            ->addColumn('status', array(
//                'header'    => Mage::helper('oggetto_blog')->__('Status'),
//                'index'     => 'status',
//                'type'      => 'select',
//            ))
            ->addColumn('action', array(
                'header' => Mage::helper('oggetto_blog')->__('Action'),
                'widht' => '100',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('oggetto_blog')->__('Edit'),
                        'url' => array('base' => '*/*/edit'),
                        'field' => 'id',
                    )
                ),
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'is_system' => true,
            ))
            ;
        parent::_prepareColumns();
    }

    /**
     * Prepare grid massaction actions
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('entity_id');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label'     => Mage::helper('oggetto_blog')->__('Delete'),
                'url'       => $this->getUrl('*/*/massDelete', array('' => '')),
                'confirm'   => Mage::helper('oggetto_blog')->__('Are you sure?')
            )
        );

        return parent::_prepareMassaction();
    }

    /**
     * Row url
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}